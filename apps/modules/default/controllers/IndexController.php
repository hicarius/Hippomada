<?php

class IndexController extends Controller
{
    public function index()
    {
        //Debugger::dump( $this->getRequest()->getParams() );        
        $oModel = Apps::getModel('Test');Debugger::dump($oModel);
        $oModel2 = Apps::getModel('Dc_Test');Debugger::dump($oModel2);
        $oModel1 = Apps::getResourceModel('Acl');Debugger::dump($oModel1);        
        //Layout::setLayout('index');
        $this->getView()->addVar('test', 155889);
        $this->getView()->addVar(
            array(
                "Male" => "M",
                "Nom" => "Jacques",
            )
        );
        //Debugger::dump( $this->getView()->getVars() );
    }

    public function test()
    {
        $this->setNoRender();        
        echo "test- no render ECHO";
    }
}