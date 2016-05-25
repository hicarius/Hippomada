<?php
class SEO
{
    static function parseSEO()
    {
        $ini =  APPS_PATH . "/configs/seo.ini" ;
        $parse = parse_ini_file ( $ini , true ) ;

        foreach ( $parse as $k => $v ) {
            $tIni[$k] = $v;
        }

        return $tIni;
    }

    static function getMetaName($MetaName, $sController, $sAction)
    {
        $data = self::parseSEO();
        return Text::__($data[$sController]["$sAction.$MetaName"]);
    }
}