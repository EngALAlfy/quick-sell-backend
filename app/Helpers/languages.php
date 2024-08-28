<?php

if (!function_exists('supported_languages')) {
    /**
     * Return system supported languages
     * @return string[]
     */
    function supported_languages(): array
    {
        return ["ar" , "en"];
    }
}
