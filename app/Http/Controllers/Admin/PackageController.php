<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\QuestionBank;
use App\Models\User;
use App\Models\Attempt;
use App\Models\Transaction;
use App\Imports\QuestionsImport;
use Maatwebsite\Excel\Facades\Excel;
class PackageController extends Controller
{

    public function index()
    {
        $packages = Package::latest()->paginate(5);
        return view('admin.packages.admin', compact('packages'));
    }

    public function create()
    {
        return view('admin.packages.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'nullable|integer|min:0',
            'duration_minutes' => 'required|integer|min:1',
            'excel_file' => 'nullable|file|mimes:xlsx,xls,csv',
        ]);

        // if ($request->hasFile('image')) {
        //     $file = $request->file('image');
        //     $filename = time().'.'.$file->getClientOriginalExtension();
        //     // $file->storeAs('public/packages', $filename);
        //     $file->storeAs('packages', $filename, 'public');

        //     $data['image'] = 'packages/'.$filename;
        // }

        $price = $request->price ?? 0;
        $data['price'] = $price;
        $data['is_active'] = $request->has('is_active');
        // $data['is_premium'] = $price > 0;
        $data['show_explanation'] = $price > 0;

        $package = Package::create($data);

        if ($request->hasFile('excel_file')) {
            $import = new QuestionsImport();

            Excel::import($import, $request->file('excel_file'));

            if (!empty($import->questionIds)) {
                $package->questions()->sync($import->questionIds);
            }
        }

        return redirect()->route('packages.index');
    }

    public function show(Package $package)
    {
        return redirect()->route('packages.index');
    }

    public function edit(Package $package)
    {
        return view('admin.packages.edit', compact('package'));
    }

    public function update(Request $request, Package $package)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'price' => 'nullable|integer|min:0',
            'duration_minutes' => 'required|integer|min:1',
        ]);

        // if ($request->hasFile('image')) {
        //     $file = $request->file('image');
        //     $filename = time().'.'.$file->getClientOriginalExtension();
        //     // $file->storeAs('public/packages', $filename);
        //     $file->storeAs('packages', $filename, 'public');

        //     $data['image'] = 'packages/'.$filename;
        // }

        $price = $request->price ?? 0;
        $data['price'] = $price;
        $data['is_active'] = $request->has('is_active');
        // $data['is_premium'] = $price > 0;
        $data['show_explanation'] = $price > 0;

        $package->update($data);

        return redirect()->route('packages.index');
    }

    public function destroy(Package $package)
    {
        $package->delete();
        return back();
    }
    
    public function questions(Package $package)
    {
        $questions = QuestionBank::with('options')->get();

        $selectedQuestions = $package->questions
            ->pluck('id')
            ->toArray();

        return view('admin.packages.questions', compact(
            'package',
            'questions',
            'selectedQuestions'
        ));
    }
    
    public function storeQuestions(Request $request, Package $package)
    {
        $selectedIds = $request->questions ?? [];

        $questions = QuestionBank::whereIn('id', $selectedIds)->get();

        $twk = $questions->where('question_type', 'TWK')->count();
        $tiu = $questions->where('question_type', 'TIU')->count();
        $tkp = $questions->where('question_type', 'TKP')->count();

        // TESTING
        $targetTwk = 1;
        $targetTiu = 1;
        $targetTkp = 1;

        // FINAL SKD
        // $targetTwk = 30;
        // $targetTiu = 35;
        // $targetTkp = 45;

        if ($twk !== $targetTwk || $tiu !== $targetTiu || $tkp !== $targetTkp) {
            return back()
                ->withInput()
                ->withErrors([
                    'questions' => "Komposisi soal belum sesuai. TWK: {$twk}/{$targetTwk}, TIU: {$tiu}/{$targetTiu}, TKP: {$tkp}/{$targetTkp}."
                ]);
        }

        // if ($twk !== 30 || $tiu !== 35 || $tkp !== 45) {
        //     return back()
        //         ->withInput()
        //         ->withErrors([
        //             'questions' => "Komposisi soal belum sesuai. TWK: {$twk}/30, TIU: {$tiu}/35, TKP: {$tkp}/45."
        //         ]);
        // }

        $package->questions()->sync($selectedIds);

        return back()->with(
            'success',
            'Soal paket berhasil disimpan.'
        );
    }
    public function dashboard()
    {
        $attemptChart = Package::withCount([
            'attempts as finished_attempts_count' => function ($query) {
                $query->whereNotNull('finished_at');
            }
        ])
        ->orderByDesc('finished_attempts_count')
        ->take(3)
        ->get();

        return view('admin.dashboardadmin', [
            'totalUsers' => User::where('role', 'user')->count(),
            'totalTryouts' => Package::count(),
            'totalPremiumUsers' => User::has('packages')->count(),
            'totalFinishedAttempts' => Attempt::whereNotNull('finished_at')->count(),
            'attemptChart' => $attemptChart,
        ]);
    }
    public function downloadTemplate()
    {
        return response()->download(
            public_path('templates/template.xlsx')
        );
    }
}
