<?php

namespace App\Services\Localisation\Handlers;


use Illuminate\Http\Request;

class RequestLocalisationHandler
{
    private $locales = [
        'en',
        'ru',
    ];

    public function handle($request): void
    {
        $locale = $this->getRequestLocale($request);
        \App::setLocale($locale);

    }

    private function getRequestLocale(Request $request): ?string
    {
        $locale = $request->get('locale');

        if (in_array($locale, $this->locales)) {
            return $locale;
        }

        return \App::getLocale();
    }

}
