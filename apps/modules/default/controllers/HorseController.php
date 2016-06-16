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
        $races = Apps::getModel('Race_Tmp')->getValidRaceForEngagement($data);
        $this->getView()->addVar('races', $races);
        $this->getView()->addVar('horseId', $data['horse_id']);
    }

    public function engagedThisRace()
    {
        $this->setNoRender();
        $data = $this->getRequest()->getPost();
        Apps::getModel('Race_Tmp')->setEngagedThisRace($data);
    }

    public function disengagedThisRace()
    {
        $this->setNoRender();
        $data = $this->getRequest()->getPost();
        Apps::getModel('Race_Tmp')->setDisengagedThisRace($data);
    }

}