<?php

namespace App\Rules;

use Illuminate\Support\Facades\Http;
use Illuminate\Contracts\Validation\Rule;

class Recaptcha implements Rule
{
    public function passes($attribute, $value)
    {
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
		'secret' =>  config('services.recaptcha.secret_key'),
		'response' => $value,
        ]);

        if ($response->successful() && $response->json('success') && $response->json('score') > 0.7) {

          return true;
	}
	    return false;
    }

    public function message()
    {
        return 'Failed to validate ReCaptcha.';
    }
}
