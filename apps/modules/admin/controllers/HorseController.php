<?php
class HorseController extends Controller
{

    public function index()
    {
        Layout::setLayout('admin');

        $horses = Apps::getModel('Horse')->getHorses();
        $this->getView()->addVar('horses', $horses);
    }

    public function createmanual()
    {
        Layout::setLayout('admin');
        $data = array(
            'name' => '',
            'proprio_id' => '',
            'trainer_id' => '',
            'eleveur_id' => '',
            'age' => '',
            'corde' => '',
            'sexe' => '',
            'quality' => '',
            'quality_production' => '',
            'father_id' => '',
            'mother_id' => '',
            'evaluation_price' => '',
            'status' => '',
            'is_system' => '',
            'origine' => '',
            'gains' => '',
            'is_qualified' => '',
            'type' => '',
        );

        if( Request::getInstance()->isPost()){
            $data = Request::getInstance()->getPost();
            $oHorse = Apps::getModel('Horse');
            $id = $oHorse->create($data);
            $oHorse->createPerformance($data['perf']);
            $oHorse->setQualityAndPrice();
            if( $id ) {
                $this->getView()->redirect('/admin/horse/');
            }
        }

        $this->getView()->addVar('data', $data);
    }

    public function createauto()
    {
        Layout::setLayout('admin');
    }

    public function edit()
    {
        Layout::setLayout('admin');

        $id = $this->getRequest()->getParam('id');

        $data =  Apps::getModel('Horse')->load($id);

        if( Request::getInstance()->isPost()){
            $data = Request::getInstance()->getPost();
            $id = Apps::getModel('Horse')->update($data);
            if( $id ) {
                $this->getView()->redirect('/admin/horse/');
            }
        }

        $this->getView()->addVar('data', $data);
    }

}