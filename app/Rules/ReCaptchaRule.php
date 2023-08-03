<?php

namespace App\Rules;


use Closure;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;

class ReCaptchaRule implements Rule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function passes($attribute, $value)
    {
        $response = Http::get("https://www.google.com/recaptcha/api/siteverify", [
            'secret' => config('services.recaptcha.secret'),
            'response' => $value
        ]);
        if ($response->json('score') < 0.7) {
            // your action if needed
        }
        return $response->json('success');
    }
    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Unable to validate recaptcha token';
    }
}
