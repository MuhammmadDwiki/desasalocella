<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
   public function __invoke(Request $request)
    {
        // Jika sudah verifikasi, redirect ke dashboard
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard'));
        }
        
        // Jika user memiliki role moderator/admin, tampilkan view khusus
        if ($request->user()->isModerator() || $request->user()->isSuperAdmin()) {
            return Inertia::location(route('verifyModeration'));
        }
        
        // Default Inertia response untuk user biasa
        return Inertia::render('Auth/VerifyEmail');
    }
}
