<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Attempt;
use Illuminate\Support\Facades\Auth;
use App\Models\Answer;
use App\Models\QuestionOption;
use Illuminate\Support\Str;

class TryoutController extends Controller
{
    public function index()
    {
        $packages = Package::where('is_active', true)
            ->whereHas('questions', fn($q) => $q->where('question_type', 'TWK'))
            ->whereHas('questions', fn($q) => $q->where('question_type', 'TIU'))
            ->whereHas('questions', fn($q) => $q->where('question_type', 'TKP'))
            ->latest()
            ->paginate(5);

        $rankings = [];

        foreach ($packages as $package) {
            $rankings[$package->id] = Attempt::with('user')
                ->where('package_id', $package->id)
                ->whereNotNull('finished_at')
                ->get()
                ->groupBy('user_id')
                ->map(function ($attempts) {
                    return $attempts->sortByDesc(function ($attempt) {
                        return $attempt->score_twk + $attempt->score_tiu + $attempt->score_tkp;
                    })->first();
                })
                ->sortByDesc(function ($attempt) {
                    return $attempt->score_twk + $attempt->score_tiu + $attempt->score_tkp;
                })
                ->values()
                ->take(10);
        }
        $user = \App\Models\User::find(Auth::id());
        $userPackageIds = $user->packages()
            ->pluck('packages.id')
            ->toArray();

        return view('tryout.tryout', compact('packages', 'rankings', 'userPackageIds'));
    }

    public function prepare(Package $package)
    {
        if ($package->price > 0) {

            $user = \App\Models\User::find(Auth::id());
            $owned = $user->packages()
                ->where('packages.id', $package->id)
                ->exists();

            if (!$owned) {
                return redirect()
                    ->route('tryout')
                    ->with('error', 'Silakan beli paket terlebih dahulu.');
            }
        }
        return view('tryout.prepare', compact('package'));
    }
    public function start(Package $package)
    {
        if (!$package->is_active) {
            return back()->with('error', 'Paket try out belum aktif.');
        }

        if ($package->price > 0) {

            $user = \App\Models\User::find(Auth::id());
            $owned = $user->packages()
                ->where('packages.id', $package->id)
                ->exists();

            if (!$owned) {
                return redirect()
                    ->route('tryout')
                    ->with('error', 'Silakan beli paket terlebih dahulu.');
            }
        }
        $hasTwk = $package->questions()->where('question_type', 'TWK')->exists();
        $hasTiu = $package->questions()->where('question_type', 'TIU')->exists();
        $hasTkp = $package->questions()->where('question_type', 'TKP')->exists();

        if (!$hasTwk || !$hasTiu || !$hasTkp) {
            return back()->with('error', 'Paket try out belum memiliki soal lengkap.');
        }

        $unfinishedAttempt = Attempt::where('user_id', Auth::id())
            ->where('package_id', $package->id)
            ->whereNull('finished_at')
            ->latest()
            ->first();

        if ($unfinishedAttempt) {
            return redirect()->route('starts', $unfinishedAttempt->id);
        }

        $deviceToken = session()->get('device_token');

        if (!$deviceToken) {
            $deviceToken = Str::uuid()->toString();
            session()->put('device_token', $deviceToken);
        }

        $attempt = Attempt::create([
            'user_id' => Auth::id(),
            'package_id' => $package->id,
            'started_at' => now(),
            'status' => 'ongoing',
            'device_token' => $deviceToken,
        ]);

        return redirect()->route('starts', $attempt->id);
    }

    public function starts(Attempt $attempt)
    {
        if ($attempt->user_id !== Auth::id()) {
            abort(403);
        }

        if ($attempt->device_token !== session()->get('device_token')) {
            return redirect()
                ->route('tryout')
                ->with('error', 'Tryout sedang berlangsung di perangkat lain.');
        }

        if ($attempt->finished_at) {
            return redirect()->route('tryout.result', $attempt->id);
        }

        $duration = $attempt->package->duration_minutes ?? 100;
        $endTime = $attempt->started_at->copy()->addMinutes($duration);

        if (now()->greaterThanOrEqualTo($endTime)) {
            $this->calculateAndFinish($attempt);

            return redirect()->route('tryout.result', $attempt->id);
        }

        $questions = $attempt->package
            ->questions()
            ->with('options')
            ->orderByRaw("
                CASE
                    WHEN question_type = 'TWK' THEN 1
                    WHEN question_type = 'TIU' THEN 2
                    WHEN question_type = 'TKP' THEN 3
                    ELSE 4
                END
            ")
            ->orderBy('question_banks.id')
            ->get();

        $answers = $attempt->answers()
            ->get()->keyBy('question_id');

        return view('tryout.starts', compact(
            'attempt',
            'questions',
            'answers'
        ));
    }

    private function calculateAndFinish(Attempt $attempt)
    {
        if ($attempt->finished_at) {
            return;
        }

        $answers = $attempt->answers()
            ->with('option.question')
            ->get();

        $scoreTwk = 0;
        $scoreTiu = 0;
        $scoreTkp = 0;

        foreach ($answers as $answer) {
            $score = $answer->option->score ?? 0;
            $category = $answer->option->question->question_type ?? null;

            if ($category === 'TWK') {
                $scoreTwk += $score;
            } elseif ($category === 'TIU') {
                $scoreTiu += $score;
            } elseif ($category === 'TKP') {
                $scoreTkp += $score;
            }
        }

        $attempt->update([
            'finished_at' => now(),
            'status' => 'finished',
            'score_twk' => $scoreTwk,
            'score_tiu' => $scoreTiu,
            'score_tkp' => $scoreTkp,
        ]);
    }

    public function saveAnswer(Request $request)
    {
        $request->validate([
            'attempt_id' => 'required|exists:attempts,id',
            'question_id' => 'required|exists:question_banks,id',
            'option_id' => 'required|exists:question_options,id',
        ]);

        $attempt = Attempt::findOrFail($request->attempt_id);
        if ($attempt->user_id !== Auth::id()) {
            abort(403);
        }

        if ($attempt->device_token !== session()->get('device_token')) {
            return response()->json([
                'success' => false,
                'message' => 'Tryout sedang berlangsung di perangkat lain.',
            ], 403);
        }

        $option = QuestionOption::findOrFail($request->option_id);

        Answer::updateOrCreate(
            [
                'attempt_id' => $request->attempt_id,
                'question_id' => $request->question_id,
            ],
            [
                'option_id' => $option->id,
                'selected_score' => $option->score,
            ]
        );

        return response()->json([
            'success' => true,
        ]);
    }

    public function submit(Attempt $attempt)
    {
        if ($attempt->user_id !== Auth::id()) {
            abort(403);
        }

        if ($attempt->device_token !== session()->get('device_token')) {
            abort(403, 'Tryout sedang berlangsung di perangkat lain.');
        }
        $this->calculateAndFinish($attempt);

        return response()->json([
            'success' => true,
            'redirect' => route('tryout.result', $attempt->id),
        ]);
    }

    public function result(Attempt $attempt)
    {
        if ($attempt->user_id !== Auth::id()) {
            abort(403);
        }
        return view('tryout.result', compact('attempt'));
    }
    public function history()
    {
        $attempts = Attempt::with('package')
            ->where('user_id', Auth::id())
            ->whereNotNull('finished_at')
            ->latest()
            ->paginate(5);

        return view('riwayat', compact('attempts'));
    }

    public function review(Attempt $attempt)
    {
        if ($attempt->user_id !== Auth::id()) {
            abort(403);
        }

        $attempt->load('package');

        if (!$attempt->package->show_explanation) {
            return redirect()
                ->route('tryout.result', $attempt->id)
                ->with('error', 'Review pembahasan hanya tersedia untuk paket premium.');
        }

        $questions = $attempt->package
            ->questions()->with('options')
            ->orderByRaw("
                CASE
                    WHEN question_type = 'TWK' THEN 1
                    WHEN question_type = 'TIU' THEN 2
                    WHEN question_type = 'TKP' THEN 3
                    ELSE 4
                END
            ")
            ->orderBy('question_banks.id')->get();

        $answers = $attempt->answers()
            ->get()
            ->keyBy('question_id');

        return view('tryout.review', compact(
            'attempt',
            'questions',
            'answers'
        ));
    }

    public function cancel(Attempt $attempt)
    {
        if ($attempt->user_id !== Auth::id()) {
            abort(403);
        }

        if ($attempt->finished_at) {
            return redirect()->route('tryout.result', $attempt->id);
        }

        $attempt->answers()->delete();
        $attempt->delete();

        return redirect()->route('tryout');
    }

    public function buy(Package $package)
    {
        if ($package->price == 0) {
            return redirect()->route('prepare', $package->id);
        }

        return view('tryout.buy', compact('package'));
    }
}
