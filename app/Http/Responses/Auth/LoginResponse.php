<?php

namespace App\Http\Responses\Auth;

use Filament\Facades\Filament;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LoginResponse implements \Filament\Http\Responses\Auth\Contracts\LoginResponse
{

    public function toResponse($request)
    {
        if (Str::endsWith(Auth::user()->email,'@admin.com')) {
            return redirect()->intended(Filament::getUrl());
        }
        return redirect()->route('dashboard');
    }
}