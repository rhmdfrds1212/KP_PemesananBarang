<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Handle email verification request.
     *
     * @param  \Illuminate\Foundation\Auth\EmailVerificationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        // Jika sudah terverifikasi sebelumnya
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('home.index')->with('status', 'Email Anda sudah diverifikasi.');
        }

        // Jika berhasil memverifikasi
        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect()->route('home.index')->with('status', 'Email Anda berhasil diverifikasi.');
    }
}
