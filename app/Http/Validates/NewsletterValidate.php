<?php

namespace App\Http\Validates;

use Illuminate\Http\Request;

class NewsletterValidate{

    public static function store(Request $request): void
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:newsletters,email',
        ]);
    }

}
