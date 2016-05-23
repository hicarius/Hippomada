<?php
/**
 * Convert HTML to MS Word file for PHP 4.2.x or earlier
 * @author Dale Attree
 * @version 1.0.1
 * @name HTML_TO_DOC
 */

/**
 * Convert HTML to MS Word file
 * @author Harish Chauhan
 * @version 1.0.0
 * @name HTML_TO_DOC
 */

class HtmlToDoc
{
    var $docFile= "";
    var $title="";
    var $htmlHead="";
    var $htmlBody="";


    /**
     * Constructor
     *
     * @return void
     */
    function HtmlToDoc()
    {
        $this->title="Untitled Document";
        $this->htmlHead="";
        $this->htmlBody="";
    }

    /**
     * Set the document file name
     *
     * @param String $docfile
     */

    function setDocFileName($docfile)
    {
        //echo 'setDocFileName Entered.<br>';
        $this->docFile=$docfile;
        if(!preg_match("/\.doc$/i",$this->docFile))
            $this->docFile.=".doc";
        return;
    }

    function setTitle($title)
    {
        //echo 'setTitle Entered.<br>';
        $this->title=$title;
    }

    /**
     * Return header of MS Doc
     *
     * @return String
     */
    function getHeader()
    {
        //echo 'getHeader Entered.<br>';
        $return  = <<<EOH
         <html xmlns:v="urn:schemas-microsoft-com:vml"
        xmlns:o="urn:schemas-microsoft-com:office:office"
        xmlns:w="urn:schemas-microsoft-com:office:word"
        xmlns="http://www.w3.org/TR/REC-html40">

        <head>
        <meta http-equiv=Content-Type content="text/html; charset=utf-8">
        <meta name=ProgId content=Word.Document>
        <meta name=Generator content="Microsoft Word 9">
        <meta name=Originator content="Microsoft Word 9">
        <!--[if !mso]>
        <style>
        v\:* {behavior:url(#default#VML);}
        o\:* {behavior:url(#default#VML);}
        w\:* {behavior:url(#default#VML);}
        .shape {behavior:url(#default#VML);}
        </style>
        <![endif]-->
        <title>$this->title</title>
        <!--[if gte mso 9]><xml>
         <w:WordDocument>
          <w:View>Print</w:View>
          <w:DoNotHyphenateCaps/>
          <w:PunctuationKerning/>
          <w:DrawingGridHorizontalSpacing>9.35 pt</w:DrawingGridHorizontalSpacing>
          <w:DrawingGridVerticalSpacing>9.35 pt</w:DrawingGridVerticalSpacing>
         </w:WordDocument>
        </xml><![endif]-->
        <style>
        <!--
         /* Font Definitions */
        @font-face
            {font-family:Verdana;
            panose-1:2 11 6 4 3 5 4 4 2 4;
            mso-font-charset:0;
            mso-generic-font-family:swiss;
            mso-font-pitch:variable;
            mso-font-signature:536871559 0 0 0 415 0;}
         /* Style Definitions */
        p.MsoNormal, li.MsoNormal, div.MsoNormal
            {mso-style-parent:"";
            margin:0in;
            margin-bottom:.0001pt;
            mso-pagination:widow-orphan;
            font-size:7.5pt;
                mso-bidi-font-size:8.0pt;
            font-family:"Verdana";
            mso-fareast-font-family:"Verdana";}
        p.small
            {mso-style-parent:"";
            margin:0in;
            margin-bottom:.0001pt;
            mso-pagination:widow-orphan;
            font-size:1.0pt;
                mso-bidi-font-size:1.0pt;
            font-family:"Verdana";
            mso-fareast-font-family:"Verdana";}
        @page Section1
            {size:8.5in 11.0in;
            margin:1.0in 1.25in 1.0in 1.25in;
            mso-header-margin:.5in;
            mso-footer-margin:.5in;
            mso-paper-source:0;}
        div.Section1
            {page:Section1;}
        -->
        </style>
        <!--[if gte mso 9]><xml>
         <o:shapedefaults v:ext="edit" spidmax="1032">
          <o:colormenu v:ext="edit" strokecolor="none"/>
         </o:shapedefaults></xml><![endif]--><!--[if gte mso 9]><xml>
         <o:shapelayout v:ext="edit">
          <o:idmap v:ext="edit" data="1"/>
         </o:shapelayout></xml><![endif]-->
         $this->htmlHead
        </head>
        <body>
EOH;
    return $return;
    }

    /**
     * Return Document footer
     *
     * @return String
     */
    function getFotter()
    {
        //echo 'getFotter Entered.<br>';
        return "</body></html>";
    }

    function createDocFromCatalogue($tData, $file,$download=false)
    {
        $rubriques = $tData['rubriques'];
        $catalogue_date = $tData['catalogue_date'];
        $option = $tData['option'];

        $html = '<div style="text-align: center;font-size: 250%;font-weight: bold;margin: 10px 0 20px 0;">Les cartels de l\'Ecole</div>
        <div style="text-align: center;
        font-size: 200%;
        font-weight: bold;">Catalogue '.$catalogue_date.'</div>
        <div style="margin: 30px 20% 40px 20%;
        padding: 10px;
        border: grey solid 1px;">
            <div style="margin: 5px 0 5px 20px;
        font-size: 120%;
        font-weight: bold;">Les cartels</div>';
            foreach ($rubriques as $rub){
                $html .= '<div style="margin-left: 50px;"><a href="#rub-'. $rub->id .'">'. $rub->label .'</a></div>';
             }
            $html .= '<div style="margin: 5px 0 5px 20px;
        font-size: 120%;
        font-weight: bold;"><a href="#cartellisants">Les cartellisants et leurs sujets de travail</a></div>
        </div>';

        $tCartellisant = $name = array();
        foreach ($rubriques as $rub){
            $html .= '<a name="rub-'. $rub->id .'" />
            <div style="">
                <div style="font-size: 175%;
            font-weight: bold;
            margin: 10px 0;">'. $rub->label .'</div>';

                $tCartel = Apps::getModel('Cartel')->dbGetCartelOfRubrique($rub->id, $option);
                usort($tCartel, 'cartelSort');
                foreach( $tCartel as $key => $cartel){
                    $plusUnId = Apps::getModel('Cartel')->dbGetPlusUnMemberId($cartel->id);

                $html .= '<div style="">
                    <div style="font-size: 110%;
            font-weight: bold;">'. ($key + 1 ) .'.&nbsp;'. Commons::encodeForPage($cartel->titre) .'</div>
                    <ul>';
                        $tab_cartellisant = Apps::getModel('Cartel')->dbGetCartelMemberInfo($cartel->id);
                        
                        usort($tab_cartellisant, 'sortCartellisant');
                        foreach($tab_cartellisant as $k => $cartellisant)
                        {
                            $tCartellisant[$cartellisant->id]['sujet'][] = array("cartel"=>$cartel->id, "key" => $key+1, "rub" => $rub->id, "cartellisant" => $cartellisant->id );
                            $tCartellisant[$cartellisant->id]['name'] = Commons::parseName($cartellisant->nom, $cartellisant->prenom);
                            $tCartellisant[$cartellisant->id]['id'] = $cartellisant->id;
                            //$tCartellisant[$cartellisant->id]['rub'] = $rub->id;
                            $plusUn = ""; //($plusUnId == $cartellisant->id) ? " <i>Plus-un :</i>" : "";
                            if(($plusUnId == $cartellisant->id))
                            {
                                $htmlPlusUn = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="text-transform:capitalize;"><i>Plus-un</i>&nbsp;:&nbsp;' . Commons::parseName($cartellisant->nom, $cartellisant->prenom) . '</span><br><br><br><br>';
                                continue;
                            }
                            $html .= '<li style="text-transform:capitalize;">'. Commons::parseName($cartellisant->nom, $cartellisant->prenom) .'</li>';
                        }                        
                    $html .= '</ul>';
                    $html .= $htmlPlusUn;
                $html .= '</div>';
                }
            $html .= '</div>';
        }

        $html .= '
        <p style="page-break-after:always;"></p>    
        <!-- LISTE DES CARTELLISANTS -->
        <a name="cartellisants" />
        <div style="">
            <div style="font-size: 175%;
        font-weight: bold;
        margin: 10px 0;">Les cartellisants et leurs sujets de travail</div>
        </div>
        <div style="margin: 10px;">
            Pour chaque cartellisant, sont mentionnés son nom, son prénom, et son sujet de travail. 
            L\'abréviation qui figure entre parenthèses précise la rubrique dans laquelle le cartel a été déclaré, 
            suivi de son emplacement dans cette rubrique. <br />
            Les abréviations des rubriques sont les suivantes : 
            <ul>
            <li>DP : Désir du psychanalyste : pratique et éthique</li>
            <li>CS : Clinique structurelle et clinique du sinthome</li>
            <li>EC : Étude des concepts fondamentaux</li>
            <li>PE : Psychanalyse avec les enfants</li>
            <li>PP : La politique de la psychanalyse et les institutions </li>
            <li>CO : Connexions</li>
            </ul>
            <br /><br />
        </div>';

        $tmp = Array();
        foreach($tCartellisant as &$ma)
            $tmp[] = &$ma["name"];
        array_multisort($tmp, $tCartellisant);

        foreach( $tCartellisant as $data)
        {

            $html .= '<div style="margin: 15px;">
                <div style="margin-top: 5px;">'. Commons::encodeForPage("{$data['name']}") .'</div>';
                
                $tSujet = $data['sujet'];
                usort($tSujet, 'sortSujet');                
                
                foreach($tSujet as $sujet){
                    $tCarteMemberInfo = Apps::getModel('Cartel')->dbGetMemberCartelInfo($sujet['cartellisant'],$sujet['cartel']);

                $html .= '<div style="margin: 5px 0 0 40px;">'
                    . $tCarteMemberInfo->sujet_travail
                    . '&nbsp;('. Commons::encodeForPage("{$sujet['rub']}") . $sujet['key'] .')';
                $html .= '</div>';
                 }
            $html .= '</div>';
        }
        
        return $this->createDoc($html,$file,$download);
    }

    /**
     * Create The MS Word Document from given HTML
     *
     * @param String $html :: URL Name like http://www.example.com
     * @param String $file :: Document File Name
     * @param Boolean $download :: Wheather to download the file or save the file
     * @return boolean
     */

    function createDocFromURL($url,$file,$download=false)
    {
        //ini_set("allow_url_fopen", 1);
        //phpinfo();
        //echo 'createDocFromURL Entered.<br>';
        //try{
            $html = file_get_contents( "http://" . $_SERVER['HTTP_HOST'] . "$url" );
            /*$curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, "http://" . $_SERVER['HTTP_HOST'] . "$url");
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HEADER, false);
            $data = curl_exec($curl);
            curl_close($curl);
        }catch(Exception $e){
            Debugger::dump($e);
        }



       /* if(!preg_match("/^http:/",$url))
            $url="http://".$url;
        $f = fopen($url,'rb');
        while(!feof($f)){
            $html= fread($f,8192);
        }*/
        //echo($html);die;

        return $this->createDoc($html,$file,$download);
    }

    /**
     * Create The MS Word Document from given HTML
     *
     * @param String $html :: HTML Content or HTML File Name like path/to/html/file.html
     * @param String $file :: Document File Name
     * @param Boolean $download :: Wheather to download the file or save the file
     * @return boolean
     */

    function createDoc($html,$file,$download=false)
    {
        //echo 'createDoc Entered.<br>';
        if(is_file($html))
            $html=@file_get_contents($html);
        $this->_parseHtml($html);
        $this->setDocFileName($file);

        $doc=$this->getHeader();
        $doc.=$this->htmlBody;
        $doc.=$this->getFotter();
        
        if($download)
        {
            //echo "down start";
            //$this->write_file($this->docFile,$doc);
            header("Cache-Control: ");// leave blank to avoid IE errors
            header("Pragma: ");// leave blank to avoid IE errors
            header("Content-type: application/octet-stream");
            header("Content-Disposition: attachment; filename=\"$this->docFile\"");
            echo $doc;
            return true;
        }
        else
        {
            return $this->write_file($this->docFile,$doc);
        }
    }

    /**
     * Parse the html and remove <head></head> part if present into html
     *
     * @param String $html
     * @return void
     * @access Private
     */

    function _parseHtml($html)
    {
        //echo '_parseHtml Entered.<br>';
        $html=preg_replace("/<!DOCTYPE((.|\n)*?)>/ims","",$html);
        $html=preg_replace("/<script((.|\n)*?)>((.|\n)*?)<\/script>/ims","",$html);
        preg_match("/<head>((.|\n)*?)<\/head>/ims",$html,$matches);
        $head=$matches[1];
        preg_match("/<title>((.|\n)*?)<\/title>/ims",$head,$matches);
        $this->title = $matches[1];
        $html=preg_replace("/<head>((.|\n)*?)<\/head>/ims","",$html);
        $head=preg_replace("/<title>((.|\n)*?)<\/title>/ims","",$head);
        $head=preg_replace("/<\/?head>/ims","",$head);
        $html=preg_replace("/<\/?body((.|\n)*?)>/ims","",$html);
        $this->htmlHead=$head;
        $this->htmlBody=$html;
        return;
    }

    /**
     * Write the content int file
     *
     * @param String $file :: File name to be save
     * @param String $content :: Content to be write
     * @param [Optional] String $mode :: Write Mode
     * @return void
     * @access boolean True on success else false
     */

    function write_file($file,$content,$mode="w")
    {
        //echo 'write_file entered!<br>';
        $fp=@fopen($file,$mode);
        if(!is_resource($fp)){
            return false;
        }
        fwrite($fp,$content);
        fclose($fp);
        return true;
    }
}

function cartelSort($a,$b){
    $comp = strnatcmp(filter($a->titre),filter($b->titre));
    if ( $comp === 0 ) {
        return 0;
    }
    return ($comp > 0) ? +1 : -1;
}

function sortCartellisant($a,$b){
    $comp = strnatcmp(filter($a->nom),filter($b->nom));
    if ( $comp === 0 ) {
        return 0;
    }
    return ($comp > 0) ? +1 : -1;
}

function filter($in) {
	$in = preg_replace_callback("/(&#[0-9]+;)/", 'convertNumToHtml', $in); 
	$in = strtolower( $in);
	$search = array ('@[éèêëÊË]@i','@[àâäÂÄ]@i','@[îïÎÏ]@i','@[ûùüÛÜ]@i','@[ôöÔÖ]@i','@[ç]@i','@[ ]@i','@[^a-zA-Z0-9_\']@i','@[.]@i');
	$replace = array ('e','a','i','u','o','c','','','');
        return preg_replace($search, $replace, $in);
}

function convertNumToHtml($m) {
	return mb_convert_encoding($m[1], "UTF-8", "HTML-ENTITIES");
}

function sortSujet($a,$b){
    $aInfo = Apps::getModel('Cartel')->dbGetMemberCartelInfo($a['cartellisant'],$a['cartel']);
    $bInfo = Apps::getModel('Cartel')->dbGetMemberCartelInfo($b['cartellisant'],$b['cartel']);
    
    $comp = strnatcmp(filter($aInfo->sujet_travail),filter($bInfo->sujet_travail));
    if ( $comp === 0 ) {
        return 0;
    }
    return ($comp > 0) ? +1 : -1;    
}