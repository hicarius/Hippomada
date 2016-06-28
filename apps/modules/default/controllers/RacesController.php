<?php

class RacesController extends Controller
{
	public function index()
	{
		Layout::setLayout('index');

		$date = date("Y-m-d");
		$this->getView()->addVar('date', $date);
	}

	public function view()
	{
		Layout::setLayout('popup-race');
		$raceId = $this->getRequest()->getParam('id');
		$isTemp = $this->getRequest()->getParam('t');
		$this->getView()->addVar('raceId', $raceId);
		$this->getView()->addVar('isTemp', $isTemp);
	}

	public function simulate()
	{
		$this->setNoRender();
		$oSimulation = Apps::getModel('Simulation');

		//header('Content-Type: application/json');
		echo json_encode($oSimulation->getSimJson(7), JSON_NUMERIC_CHECK);
	}

}