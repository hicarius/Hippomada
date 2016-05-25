<?php
class Text
{
	static $_lang = 'fr';

	public static function __($text)
	{
		$data = self::parseSEO();
		return utf8_encode($data[$text]);
	}

	static function parseSEO()
	{
		$ini =  APPLICATION_PATH . "/languages/lang_" . self::$_lang . ".ini" ;
		$parse = parse_ini_file ( $ini , true ) ;

		foreach ( $parse as $k => $v ) {
			$tIni[$k] = $v;
		}

		return $tIni;
	}
}