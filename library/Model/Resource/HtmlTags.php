<?php
class HtmlTags
{
    static function htmlInput( $sFilter )
    {
        return "<input class='filter_item' type='text' id='$sFilter' name='$sFilter' value='' />";
    }
    
    static function htmlText( $sFilter, $sValue, $sText )
    {
        return "<input class='filter_item' type='hidden' id='$sFilter' name='$sFilter' value='$sValue' />
                <input type='text' readonly='readonly' style='background: none repeat scroll 0 0 #FFFFFF;border: medium none;width: 50px;' value='$sText' />";
    }    

    static function htmlSelect( $sFilter, $tValue )
    {
        $sHtml =  "<select class='filter_item' id='$sFilter' name='$sFilter'>";
        foreach( $tValue as $iKey => $sVal )
        {
            $sHtml .=  "<option value='$iKey'>$sVal</option>";
        }
        $sHtml .=  "<select>";
        return $sHtml;
    }

    static function htmlDate( $sFilter )
    {
        $sBegin = "<input style='margin-left:165px' class='filter_item date_input' type='text' id='b_$sFilter' name='b_$sFilter' value='' />";
        $sEnd = "<input style='margin-left:0' class='filter_item date_input' type='text' id='f_$sFilter' name='f_$sFilter' value='' />";

        return "<label style='margin-left: 130px;'>entre</label> $sBegin et $sEnd";
    }
}