<?php

class HorseController extends Controller
{
    public function view()
    {
        Layout::setLayout('popup');
        $horseId = $this->getRequest()->getParam('id');
        $this->getView()->addVar('horseId', $horseId);
    }

}