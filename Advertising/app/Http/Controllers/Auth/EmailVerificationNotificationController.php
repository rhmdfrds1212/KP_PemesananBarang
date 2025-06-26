<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider as ProvidersRouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(ProvidersRouteServiceProvider::HOME)
                ->with('status', 'Email Anda sudah diverifikasi.');
        }

        // Kirim ulang link verifikasi
        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'Link verifikasi baru telah dikirim ke email Anda.');
    }
}
