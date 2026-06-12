<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->subject('Verifikasi Email Juara ASN')
                ->greeting('Halo, '.$notifiable->name.'!')
                ->line('Terima kasih telah mendaftar di RaihASN.')
                ->line('Silakan klik tombol berikut untuk memverifikasi email Anda.')
                ->action('Verifikasi Email', $url)
                ->line('Jika Anda tidak melakukan pendaftaran, abaikan email ini.')
                ->salutation('Salam Hangat,' . "\n" . 'Tim Juara ASN');
        });
    }
}
