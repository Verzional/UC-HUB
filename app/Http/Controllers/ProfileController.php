<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProfileExtraUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();

    if ($user->role === 'ICE') {
        return view('profile.ice.edit', compact('user'));
    }

    return view('profile.student.edit', compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        $user->fill($request->validated());

        // Reset email verification if email changed
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function updateExtra(ProfileExtraUpdateRequest $request)
    {
        $user = $request->user();

        if ($request->filled('about')) {
            $user->about = $request->about;
        }

        if ($request->filled('portfolio_path')) {
            $user->portfolio_path = $request->portfolio_path;
        }

        if ($request->hasFile('cv_path')) {
            if ($user->cv_path) {
                Storage::disk('public')->delete($user->cv_path);
            }

            $user->cv_path = $request->file('cv_path')->store('cvs', 'public');
        }

        $user->save();

        return back()->with('success', 'Profile updated');
    }
}
