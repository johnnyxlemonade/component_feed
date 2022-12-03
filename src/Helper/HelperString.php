<?php declare(strict_types = 1);

namespace Lemonade\Feed\Helper;

/**
 * Class HelperString
 * @package Lemonade\Feed
 */
final class HelperString {

   
    /**
     * Fix string
     * @param string $string
     */
    public static function fixString(string $string = null) {
        return ($string <> "" ? preg_replace ('/[^\x{0009}\x{000a}\x{000d}\x{0020}-\x{D7FF}\x{E000}-\x{FFFD}]+/u', ' ', $string) : null);
    }
    
    /**
     * Fix string xml
     * @param string $string
     * @return string
     */
    public static function fixUtf8(string $string = null) {
        
        if($string == "") {
            return null;
        }
        
        // detect UTF-8
        if (preg_match('#[\x80-\x{1FF}\x{2000}-\x{3FFF}]#u', $string)) {
            return $string;
        }
        
        // detect WINDOWS-1250
        if (preg_match('#[\x7F-\x9F\xBC]#', $string)) {
            return iconv("WINDOWS-1250", "UTF-8", $string);
        }
        
        // assume ISO-8859-2
        return iconv('ISO-8859-2', 'UTF-8', $string);
        
    }

}
