<?php

class StableController extends Controller
{
	public function index()
	{
		Layout::setLayout('index');
	}

	public function create()
	{
		$this->setNoRender();

		$params = $this->getRequest()->getPost();

		$params['level'] = BEGINEER_LEVEL;
		$params['banque'] = BEGINEER_BANQUE;
		$params['gold'] = BEGINEER_GOLD;

		$oStable = Apps::getModel('Stable');
		if($oStable->create($params)){
			$this->getView()->redirect('/stable/success');
		}
	}
}