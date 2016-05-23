<?php
class View extends View_Abstract
{
    protected static $_oInstance;

    public static function getInstance()
    {
        if (null === self::$_oInstance) {
            self::$_oInstance = new self();
        }
        return self::$_oInstance;
    }

    public function redirect($sUrl, $bPermanent = false)
    {
        if ($bPermanent){
            $this->_tHeaders['Status'] = '301 Moved Permanently';
        }else{
            $this->_tHeaders['Status'] = '302 Found';
        }
        $this->_tHeaders['location'] = $sUrl;
    }

    public function printOut()
    {
        foreach ($this->_tHeaders as $sKey => $sValue) {
            header($sKey. ':' . $sValue);
        }
        echo $this->_sBody;
    }

    public function render($sFile)
    {        
        extract($this->_tVars);
        ob_start();
        include($sFile);
        $sHtml = ob_get_contents();
        ob_end_clean();
        return $sHtml;
    }
}