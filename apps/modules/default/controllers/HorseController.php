<?php

class HorseController extends Controller
{
    public function view()
    {
        Layout::setLayout('popup');
        $horseId = $this->getRequest()->getParam('id');
        $this->getView()->addVar('horseId', $horseId);
    }

    public function validTraining()
    {
        $this->setNoRender();
        $data = $this->getRequest()->getPost();
        $oTraining = Apps::getModel('Training')->updateTraining($data);
    }

    public function validRaceForEngagement()
    {
        Layout::setLayout('ajax');
        $data = $this->getRequest()->getPost();
        $races = Apps::getModel('Race_Tmp')->getvalidRaceForEngagement($data);
        $this->getView()->addVar('races', $races);
    }

}