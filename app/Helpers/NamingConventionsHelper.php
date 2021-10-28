<?php

namespace App\Helpers;

use Illuminate\Support\Str;

/**
 * Naming Conventions helper
 */
class NamingConventionsHelper
{
    /**
     * @param $string
     * @param $headline
     * @return string
     */
    public static function pluralToSingular($string, $headline = false, $case = false)
    {
        $string = NamingConventionsHelper::singularEnding($string);

        if ($headline !== false) {
            $string = str_replace(" ", $headline, Str::headline($string));
        }

        if ($case === 'lcfirst') {
            $string = lcfirst($string);
        } elseif ($case === 'strtolower') {
            $string = strtolower($string);
        }

        return $string;
    }

    /**
     * @param $string
     * @return string
     */
    public static function headline($string)
    {
        $string = Str::headline($string);


        return $string;
    }


    /**
     * @param $string
     * @param $headline
     * @return string
     */
    public static function singularToPlural($string, $lowercase = false)
    {
        if (substr($string, -1) === 'y') {
            $string = substr($string, 0, -1) . "ies";
        } else {
            $string = $string . "s";
        }

        if ($lowercase) {
            $string = lowercase($string);
        }

        return $string;
    }


    /**
     * @param $string
     * @return string
     */
    public static function singularEnding($string)
    {
        if (substr($string, -3) === 'ies') {
            $string = substr($string, 0, -3) . "y";
        } elseif (substr($string, -1) === 's') {
            $string = substr($string, 0, -1);
        }
        return $string;
    }

}


