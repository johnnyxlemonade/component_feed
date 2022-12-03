<?php declare(strict_types = 1);

namespace Lemonade\Feed\Cache;

/**
 * FileName
 */
class FileName {

	public static $maps = [
	    
		"de" => [ 
			"Ä" => "Ae", "Ö" => "Oe", "Ü" => "Ue", "ä" => "ae", "ö" => "oe", "ü" => "ue", "ß" => "ss",
			"ẞ" => "SS"
		],
		"latin" => [
			"À" => "A", "Á" => "A", "Â" => "A", "Ã" => "A", "Ä" => "A", "Å" => "A","Ă" => "A", "Æ" => "AE", "Ç" =>
			"C", "È" => "E", "É" => "E", "Ê" => "E", "Ë" => "E", "Ì" => "I", "Í" => "I", "Î" => "I",
			"Ï" => "I", "Ð" => "D", "Ñ" => "N", "Ò" => "O", "Ó" => "O", "Ô" => "O", "Õ" => "O", "Ö" =>
			"O", "Ő" => "O", "Ø" => "O", "Œ" => "OE" ,"Ș" => "S","Ț" => "T", "Ù" => "U", "Ú" => "U", "Û" => "U", "Ü" => "U", "Ű" => "U",
			"Ý" => "Y", "Þ" => "TH", "ß" => "ss", "à" => "a", "á" => "a", "â" => "a", "ã" => "a", "ä" =>
			"a", "å" => "a", "ă" => "a", "æ" => "ae", "ç" => "c", "è" => "e", "é" => "e", "ê" => "e", "ë" => "e",
			"ì" => "i", "í" => "i", "î" => "i", "ï" => "i", "ð" => "d", "ñ" => "n", "ò" => "o", "ó" =>
			"o", "ô" => "o", "õ" => "o", "ö" => "o", "ő" => "o", "ø" => "o", "œ" => "oe", "ș" => "s", "ț" => "t", "ù" => "u", "ú" => "u",
			"û" => "u", "ü" => "u", "ű" => "u", "ý" => "y", "þ" => "th", "ÿ" => "y"
		],
		"latin_symbols" => [
			"©" => "(c)"
		],
		"el" => [ 
			"α" => "a", "β" => "b", "γ" => "g", "δ" => "d", "ε" => "e", "ζ" => "z", "η" => "h", "θ" => "8",
			"ι" => "i", "κ" => "k", "λ" => "l", "μ" => "m", "ν" => "n", "ξ" => "3", "ο" => "o", "π" => "p",
			"ρ" => "r", "σ" => "s", "τ" => "t", "υ" => "y", "φ" => "f", "χ" => "x", "ψ" => "ps", "ω" => "w",
			"ά" => "a", "έ" => "e", "ί" => "i", "ό" => "o", "ύ" => "y", "ή" => "h", "ώ" => "w", "ς" => "s",
			"ϊ" => "i", "ΰ" => "y", "ϋ" => "y", "ΐ" => "i",
			"Α" => "A", "Β" => "B", "Γ" => "G", "Δ" => "D", "Ε" => "E", "Ζ" => "Z", "Η" => "H", "Θ" => "8",
			"Ι" => "I", "Κ" => "K", "Λ" => "L", "Μ" => "M", "Ν" => "N", "Ξ" => "3", "Ο" => "O", "Π" => "P",
			"Ρ" => "R", "Σ" => "S", "Τ" => "T", "Υ" => "Y", "Φ" => "F", "Χ" => "X", "Ψ" => "PS", "Ω" => "W",
			"Ά" => "A", "Έ" => "E", "Ί" => "I", "Ό" => "O", "Ύ" => "Y", "Ή" => "H", "Ώ" => "W", "Ϊ" => "I",
			"Ϋ" => "Y"
		],
		"tr" => [ 
			"ş" => "s", "Ş" => "S", "ı" => "i", "İ" => "I", "ç" => "c", "Ç" => "C", "ü" => "u", "Ü" => "U",
			"ö" => "o", "Ö" => "O", "ğ" => "g", "Ğ" => "G"
		],
		"bg" => [ 
			"Щ" => "Sht", "Ш" => "Sh", "Ч" => "Ch", "Ц" => "C", "Ю" => "Yu", "Я" => "Ya",
			"Ж" => "J",   "А" => "A",  "Б" => "B",  "В" => "V", "Г" => "G",  "Д" => "D",
			"Е" => "E",   "З" => "Z",  "И" => "I",  "Й" => "Y", "К" => "K",  "Л" => "L",
			"М" => "M",   "Н" => "N",  "О" => "O",  "П" => "P", "Р" => "R",  "С" => "S",
			"Т" => "T",   "У" => "U",  "Ф" => "F",  "Х" => "H", "Ь" => "",   "Ъ" => "A",
			"щ" => "sht", "ш" => "sh", "ч" => "ch", "ц" => "c", "ю" => "yu", "я" => "ya",
			"ж" => "j",   "а" => "a",  "б" => "b",  "в" => "v", "г" => "g",  "д" => "d",
			"е" => "e",   "з" => "z",  "и" => "i",  "й" => "y", "к" => "k",  "л" => "l",
			"м" => "m",   "н" => "n",  "о" => "o",  "п" => "p", "р" => "r",  "с" => "s",
			"т" => "t",   "у" => "u",  "ф" => "f",  "х" => "h", "ь" => "",   "ъ" => "a"
		],
		"ru" => [
			"а" => "a", "б" => "b", "в" => "v", "г" => "g", "д" => "d", "е" => "e", "ё" => "yo", "ж" => "zh",
			"з" => "z", "и" => "i", "й" => "i", "к" => "k", "л" => "l", "м" => "m", "н" => "n", "о" => "o",
			"п" => "p", "р" => "r", "с" => "s", "т" => "t", "у" => "u", "ф" => "f", "х" => "h", "ц" => "c",
			"ч" => "ch", "ш" => "sh", "щ" => "sh", "ъ" => "", "ы" => "y", "ь" => "", "э" => "e", "ю" => "yu",
			"я" => "ya",
			"А" => "A", "Б" => "B", "В" => "V", "Г" => "G", "Д" => "D", "Е" => "E", "Ё" => "Yo", "Ж" => "Zh",
			"З" => "Z", "И" => "I", "Й" => "I", "К" => "K", "Л" => "L", "М" => "M", "Н" => "N", "О" => "O",
			"П" => "P", "Р" => "R", "С" => "S", "Т" => "T", "У" => "U", "Ф" => "F", "Х" => "H", "Ц" => "C",
			"Ч" => "Ch", "Ш" => "Sh", "Щ" => "Sh", "Ъ" => "", "Ы" => "Y", "Ь" => "", "Э" => "E", "Ю" => "Yu",
			"Я" => "Ya",
			"№" => ""
		],
		"uk" => [
			"Є" => "Ye", "І" => "I", "Ї" => "Yi", "Ґ" => "G", "є" => "ye", "і" => "i", "ї" => "yi", "ґ" => "g"
		],
        "kk" => [
            "Ә" => "A", "Ғ" => "G", "Қ" => "Q", "Ң" => "N", "Ө" => "O", "Ұ" => "U", "Ү" => "U", "Һ" => "H",
            "ә" => "a", "ғ" => "g", "қ" => "q", "ң" => "n", "ө" => "o", "ұ" => "u", "ү" => "u", "һ" => "h",
        ],
		"cs" => [
			"č" => "c", "ď" => "d", "ě" => "e", "ň" => "n", "ř" => "r", "š" => "s", "ť" => "t", "ů" => "u",
			"ž" => "z", "Č" => "C", "Ď" => "D", "Ě" => "E", "Ň" => "N", "Ř" => "R", "Š" => "S", "Ť" => "T",
			"Ů" => "U", "Ž" => "Z"
		],
		"pl" => [
			"ą" => "a", "ć" => "c", "ę" => "e", "ł" => "l", "ń" => "n", "ó" => "o", "ś" => "s", "ź" => "z",
			"ż" => "z", "Ą" => "A", "Ć" => "C", "Ę" => "e", "Ł" => "L", "Ń" => "N", "Ó" => "O", "Ś" => "S",
			"Ź" => "Z", "Ż" => "Z"
		],
		"ro" => [
			"ă" => "a", "â" => "a", "î" => "i", "ș" => "s", "ț" => "t", "Ţ" => "T", "ţ" => "t"
		],
		"lv" => [
			"ā" => "a", "č" => "c", "ē" => "e", "ģ" => "g", "ī" => "i", "ķ" => "k", "ļ" => "l", "ņ" => "n",
			"š" => "s", "ū" => "u", "ž" => "z", "Ā" => "A", "Č" => "C", "Ē" => "E", "Ģ" => "G", "Ī" => "i",
			"Ķ" => "k", "Ļ" => "L", "Ņ" => "N", "Š" => "S", "Ū" => "u", "Ž" => "Z"
		],
		"lt" => [
			"ą" => "a", "č" => "c", "ę" => "e", "ė" => "e", "į" => "i", "š" => "s", "ų" => "u", "ū" => "u", "ž" => "z",
			"Ą" => "A", "Č" => "C", "Ę" => "E", "Ė" => "E", "Į" => "I", "Š" => "S", "Ų" => "U", "Ū" => "U", "Ž" => "Z"
		],
		"vi" => [
			"Á" => "A", "À" => "A", "Ả" => "A", "Ã" => "A", "Ạ" => "A", "Ă" => "A", "Ắ" => "A", "Ằ" => "A", "Ẳ" => "A", "Ẵ" => "A", "Ặ" => "A", "Â" => "A", "Ấ" => "A", "Ầ" => "A", "Ẩ" => "A", "Ẫ" => "A", "Ậ" => "A",
			"á" => "a", "à" => "a", "ả" => "a", "ã" => "a", "ạ" => "a", "ă" => "a", "ắ" => "a", "ằ" => "a", "ẳ" => "a", "ẵ" => "a", "ặ" => "a", "â" => "a", "ấ" => "a", "ầ" => "a", "ẩ" => "a", "ẫ" => "a", "ậ" => "a",
			"É" => "E", "È" => "E", "Ẻ" => "E", "Ẽ" => "E", "Ẹ" => "E", "Ê" => "E", "Ế" => "E", "Ề" => "E", "Ể" => "E", "Ễ" => "E", "Ệ" => "E",
			"é" => "e", "è" => "e", "ẻ" => "e", "ẽ" => "e", "ẹ" => "e", "ê" => "e", "ế" => "e", "ề" => "e", "ể" => "e", "ễ" => "e", "ệ" => "e",
			"Í" => "I", "Ì" => "I", "Ỉ" => "I", "Ĩ" => "I", "Ị" => "I", "í" => "i", "ì" => "i", "ỉ" => "i", "ĩ" => "i", "ị" => "i",
			"Ó" => "O", "Ò" => "O", "Ỏ" => "O", "Õ" => "O", "Ọ" => "O", "Ô" => "O", "Ố" => "O", "Ồ" => "O", "Ổ" => "O", "Ỗ" => "O", "Ộ" => "O", "Ơ" => "O", "Ớ" => "O", "Ờ" => "O", "Ở" => "O", "Ỡ" => "O", "Ợ" => "O",
			"ó" => "o", "ò" => "o", "ỏ" => "o", "õ" => "o", "ọ" => "o", "ô" => "o", "ố" => "o", "ồ" => "o", "ổ" => "o", "ỗ" => "o", "ộ" => "o", "ơ" => "o", "ớ" => "o", "ờ" => "o", "ở" => "o", "ỡ" => "o", "ợ" => "o",
			"Ú" => "U", "Ù" => "U", "Ủ" => "U", "Ũ" => "U", "Ụ" => "U", "Ư" => "U", "Ứ" => "U", "Ừ" => "U", "Ử" => "U", "Ữ" => "U", "Ự" => "U",
			"ú" => "u", "ù" => "u", "ủ" => "u", "ũ" => "u", "ụ" => "u", "ư" => "u", "ứ" => "u", "ừ" => "u", "ử" => "u", "ữ" => "u", "ự" => "u",
			"Ý" => "Y", "Ỳ" => "Y", "Ỷ" => "Y", "Ỹ" => "Y", "Ỵ" => "Y", "ý" => "y", "ỳ" => "y", "ỷ" => "y", "ỹ" => "y", "ỵ" => "y",
			"Đ" => "D", "đ" => "d"
		],
		"ar" => [
			"أ" => "a", "ب" => "b", "ت" => "t", "ث" => "th", "ج" => "g", "ح" => "h", "خ" => "kh", "د" => "d",
			"ذ" => "th", "ر" => "r", "ز" => "z", "س" => "s", "ش" => "sh", "ص" => "s", "ض" => "d", "ط" => "t",
			"ظ" => "th", "ع" => "aa", "غ" => "gh", "ف" => "f", "ق" => "k", "ك" => "k", "ل" => "l", "م" => "m",
			"ن" => "n", "ه" => "h", "و" => "o", "ي" => "y",
			"ا" => "a", "إ" => "a", "آ" => "a", "ؤ" => "o", "ئ" => "y", "ء" => "aa",
			"٠" => "0", "١" => "1", "٢" => "2", "٣" => "3", "٤" => "4", "٥" => "5", "٦" => "6", "٧" => "7", "٨" => "8", "٩" => "9",
		],
		"fa" => [
			"گ" => "g", "ژ" => "j", "پ" => "p", "چ" => "ch", "ی" => "y", "ک" => "k",
			"۰" => "0", "۱" => "1", "۲" => "2", "۳" => "3", "۴" => "4", "۵" => "5", "۶" => "6", "۷" => "7", "۸" => "8", "۹" => "9",
		],
		"sr" => [
			"ђ" => "dj", "ј" => "j", "љ" => "lj", "њ" => "nj", "ћ" => "c", "џ" => "dz", "đ" => "dj",
			"Ђ" => "Dj", "Ј" => "j", "Љ" => "Lj", "Њ" => "Nj", "Ћ" => "C", "Џ" => "Dz", "Đ" => "Dj"
		],
		"az" => [
			"ç" => "c", "ə" => "e", "ğ" => "g", "ı" => "i", "ö" => "o", "ş" => "s", "ü" => "u",
			"Ç" => "C", "Ə" => "E", "Ğ" => "G", "İ" => "I", "Ö" => "O", "Ş" => "S", "Ü" => "U"
		],
		"sk" => [
			"ĺ" => "l", "ľ" => "l", "ŕ" => "r"
		]
	];

	/**
	 * List of words to remove from URLs.
	 */
	public static $removeList = [
		"a", "an", "as", "at", "before", "but", "by", "for", "from",
		"is", "in", "into", "like", "of", "off", "on", "onto", "per",
		"since", "than", "the", "this", "that", "to", "up", "via",
		"with", "nebo"
	];

	/**
	 * Mapa znaku
	 */
	private static $map = [];

	/**
	 * Mapa znaku jako string
	 */
	private static $chars = "";

	/**
	 * Mapa znaku
	 */
	private static $regex = "";

	/**
	 * Aktualni jazyk
	 */
	private static $language = "";

	/**
	 * Initializes the character map.
     * @param string $language
	 */
	private static function init($language = "") {
	    
		if (\count(self::$map) > 0 && (($language == "") || ($language == self::$language))) {
			return;
		}

		/* Is a specific map associated with $language ? */
		if (isset(self::$maps[$language]) && \is_array(self::$maps[$language])) {
		    
			/* Move this map to end. This means it will have priority over others */		    
			$m = self::$maps[$language];
			unset(self::$maps[$language]);
			self::$maps[$language] = $m;
		}
		
		/* Reset static vars */
		self::$language = $language;
		self::$map   = [];
		self::$chars = "";

		foreach (self::$maps as $map) {
			foreach ($map as $orig => $conv) {
				self::$map[$orig] = $conv;
				self::$chars .= $orig;
			}
		}

		self::$regex = '/[' . \preg_quote(self::$chars, '/') . ']/u';
	}
	
	/**	 
	 * Pridat vyjimky na dirty words
     * @param mixed $words
	 */
	public static function removeWords($words) {
	    
		$words = \is_array($words) ? $words : [$words];
		
		self::$removeList = \array_unique(\array_merge(self::$removeList, $words));
	}

	/**
     * Prevod na ASCII    
     * @param string $text
     * @param string $language
     * @return string
	 */
	public static function downcode($text, $language = "") {
	    
		self::init($language);

		if (\preg_match_all (self::$regex, $text, $matches)) {
			for ($i = 0; $i < \count ($matches[0]); $i++) {
				$char = $matches[0][$i];
				
				if (isset (self::$map[$char])) {
					$text = \str_replace($char, self::$map[$char], $text);
				}
			}
		}
		
		return $text;
	}

	/**
	 * Vygeneruje nazev souboru
	 * @param string $text
	 * @param number $length
	 * @param string $language
	 * @param boolean $file_name
	 * @param boolean $use_remove_list
	 * @param boolean $lower_case
	 * @param boolean $treat_underscore_as_space
	 * @return string
	 */
	public static function filter($text, $length = 120, $language = "", bool $isFile = false, bool $removeList = true, bool $toLower = true, bool $asSpace = true) {
	    
		$text = self::downcode($text, $language);

		
		if ($removeList) {
		    $text = \preg_replace('/\b(' . \join ('|', self::$removeList) . ')\b/i', '', $text);
		}

		// downcode neni? vyhod znaky
		$remove_pattern = ($isFile) ? "/[^_\-\-a-zA-Z0-9\s]/u" : "/[^\s_\-a-zA-Z0-9]/u";
		
		
		$text = \preg_replace($remove_pattern, '', $text); // nepotrebne znaky
		
		// pokud bude soubor, odstranit dot
		if($isFile) {
		    $text = \preg_replace('/\.{2,}/', ".", $text);
		}
				
		if ($asSpace) {
		    	$text = \str_replace ("_", " ", $text);  // mezery
		}
		
		$text = \preg_replace('/^\s+|\s+$/u', '', $text); // mezery vepredu, vzadu
		$text = \preg_replace('/[-\s]+/u', '-', $text);   // mezery - pomlcky
		
		if ($toLower) {
			$text = \strtolower($text);                 // mala pismena
		}

		return \trim(\substr($text, 0, $length), "-"); // oriznuti na prvni znaky
	}
	
	
	
	/**
	 * Alias pro filter (pro url)
	 * @param string $url
	 * @return string
	 */
	public static function asUrl($url) {
	    
	    return self::filter($url, 200, "", false);
	}
	
	
	/**
	 * Alias pro filter (pro soubory)
	 * @param string $text
	 * @return string
	 */
	public static function asFile($name) {
	    
	    return self::filter($name, 80, "", true);
	}

	
}