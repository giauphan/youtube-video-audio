<?php

namespace App\Http\Controllers;

class LanguageController extends Controller
{
    public function __invoke($locale)
    {
        if (! in_array($locale, ['en', 'vi'])) {
            abort(404);
        }
        session()->put('locale', $locale);

        return redirect()->to('/');
    }
}
