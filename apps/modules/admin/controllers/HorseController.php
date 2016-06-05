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
            'robe' => '',
        );

        if( Request::getInstance()->isPost()){
            $post = Request::getInstance()->getPost();
            $oHorse = Apps::getModel('Horse');
            $id = $oHorse->create($post);
            $oHorse->createPerformance($post['perf']);
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

        $data =  Apps::getModel('Horse')->load($id)->getData();
        if( Request::getInstance()->isPost()){
            $post = Request::getInstance()->getPost();
            $id = Apps::getModel('Horse')->update($post);
            if( $id ) {
                $this->getView()->redirect('/admin/horse/');
            }
        }

        $this->getView()->addVar('data', $data);
    }

    public function ajaxGetHorse()
    {
        $this->setNoRender();

        $post =  Request::getInstance()->getPost();
        $data =  Apps::getModel('Horse')->loadByName($post['input'], array( 'type' => $post['htyp']))->getData();
        $result = array();
        foreach($data as $item){
            //$result[] = array('id' => $item['id'], 'name' => $item['name']);
            $result[] = $item['id'] . '// ' . $item['name'];
        }

        echo json_encode($result);
    }

    public function ajaxGenerateHorse()
    {
        $this->setNoRender();
        $post =  Request::getInstance()->getPost();
        $etalon = explode('//', $post['e']);
        $poule = explode('//', $post['p']);

        $result = Apps::getModel('Horse')->generate($etalon[0], $poule[0]);

        Debugger::dump($result);
    }

}