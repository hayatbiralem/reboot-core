<?php if (!defined('ABSPATH')) exit('No direct script access allowed');

if (!function_exists('reboot_turkish_string_comparison')) {

    /**
     * @source http://ahmetertem.com.tr/php-turkce-string-karsilastirma-ve-dizi-sorting-siralama/
     * @param $a
     * @param $b
     * @return int
     */

    function reboot_turkish_string_comparison($a, $b)
    {
        $lcases = array('a', 'b', 'c', 'ç', 'd', 'e', 'f', 'g', 'ğ', 'h', 'ı', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'ö', 'p', 'q', 'r', 's', 'ş', 't', 'u', 'ü', 'w', 'v', 'y', 'z');
        $ucases = array('A', 'B', 'C', 'Ç', 'D', 'E', 'F', 'G', 'Ğ', 'H', 'I', 'İ', 'J', 'K', 'L', 'M', 'N', 'O', 'Ö', 'P', 'Q', 'R', 'S', 'Ş', 'T', 'U', 'Ü', 'W', 'V', 'Y', 'Z');
        $am = mb_strlen($a, 'UTF-8');
        $bm = mb_strlen($b, 'UTF-8');
        $maxlen = $am > $bm ? $bm : $am;
        for ($ai = 0; $ai < $maxlen; $ai++) {
            $aa = mb_substr($a, $ai, 1, 'UTF-8');
            $ba = mb_substr($b, $ai, 1, 'UTF-8');
            if ($aa != $ba) {
                $apos = in_array($aa, $lcases) ? array_search($aa, $lcases) : array_search($aa, $ucases);
                $bpos = in_array($ba, $lcases) ? array_search($ba, $lcases) : array_search($ba, $ucases);
                if ($apos !== $bpos) {
                    return $apos > $bpos ? 1 : -1;
                }
            }
        }
        return 0;

    }

}