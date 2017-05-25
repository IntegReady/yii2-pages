<?php

namespace integready\pages;

use Yii;

class PageHelper
{
    const PREVIEW_SNIPPET_LIMIT = 160;
    const ALIAS_LIMIT           = 53;
    const PREVIEW_DELIMITER     = '|';

    const DATETIME_FORMAT_RU                       = 'Y-m-d H:i:s';
    const DATETIME_FORMAT_ICU_RU                   = 'yyyy-mm-dd hh:ii:ss';
    const DATETIME_FORMAT_RU_MASK                  = 'ГГГГ-ММ-ДД ЧЧ:ММ';
    const DATETIME_FORMAT_PUBLICATIONS_PLACEHOLDER = 'YYYY-MM-DD hh:mm';

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
     * Получение всех возможныж языков (в соотв. с настройками модуля)
     * @return array
     */
    public static function getLanguagesList()
    {
        $module     = Yii::$app->getModule('pages');
        $aLanguages = $module->allowedLanguages;
        foreach ($aLanguages as $key => $language) {
            $aLanguages[$language] = $language;
            unset($aLanguages[$key]);
        }

        return $aLanguages;
    }
}