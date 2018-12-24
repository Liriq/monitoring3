<?php

namespace App\Helpers;

use LaravelGettext;

class LaravelGettextHelper
{
    
    /**
     * Get the country portion of the locale
     * (ex. en_GB returns gb)
     *
     * @param string|null $locale
     * @param boolean $strToLow
     * @return string|null
     */
    public static function getLocaleCountry($locale = null, $strToLow = true)
    {
        if (is_null($locale)) {
            $locale = LaravelGettext::getLocale();
        }

        $localeArray = explode('_', $locale);

        if (!isset($localeArray[1])) {
            return null;
        }

        return $strToLow ? strtolower($localeArray[1]) : $localeArray[1];
    }
    
}