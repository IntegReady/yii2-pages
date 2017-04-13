<?php

namespace muravshchyk\pages;

class PageHelper
{
    const PREVIEW_SNIPPET_LIMIT = 160;
    const ALIAS_LIMIT           = 53;
    const PREVIEW_DELIMITER     = '|';

    /**
     * @param string $string
     * @param int $length
     *
     * @return string
     */
    public static function makePreviewSnippet($string, $length = self::PREVIEW_SNIPPET_LIMIT)
    {
        $string = strip_tags($string);

        if (strlen($string) > $length) {
            $string    = wordwrap($string, $length, self::PREVIEW_DELIMITER);
            $string    = explode(self::PREVIEW_DELIMITER, $string, 2);
            $string[0] = preg_replace('/[\s\.,\-]+$/', '', $string[0]);
            $string    = trim($string[0]) . '...';
        }

        return $string;
    }

    /**
     * @return array
     */
    public static function getLanguagesList()
    {
        return [
            'ru-RU' => 'ru-RU',
            'en-US' => 'en-US',
        ];
    }
}