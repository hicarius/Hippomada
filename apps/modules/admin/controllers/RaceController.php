<?php
class RaceController extends Controller
{

    public function index()
    {
        Layout::setLayout('admin');

        $races = Apps::getModel('Race')->getRacesOfficial();
        $this->getView()->addVar('races', $races);
    }

    public function indexTmp()
    {
        Layout::setLayout('admin');

        $races = Apps::getModel('Race_Tmp')->getRaces();
        $this->getView()->addVar('races', $races);
    }

    public function indexEnd()
    {
        Layout::setLayout('admin');

        $races = Apps::getModel('Race')->getRacesEnd();
        $this->getView()->addVar('races', $races);
    }

    public function createmanual()
    {
        Layout::setLayout('admin');
        $data = array(
            'name' => '',
            'category_id' => '',
            'group_id' => '',
            'type_id' => '',
            'piste_id' => '',
            'hippodrome_id' => '',
            'lenght' => '',
            'corde' => '',
            'race_date' => '',
            'price' => '',
            'recul_gain' => '',
            'recul_meter' => '',
            'max_gain' => '',
            'age_min' => '',
            'age_max' => '',
            'victory_price' => '',
            'status' => '',
            'meeting' => '',
            'sexe' => '',
        );

        if( Request::getInstance()->isPost()){
            $data = Request::getInstance()->getPost();
            $id = Apps::getModel('Race')->create($data);
            if( $id ) {
                $this->getView()->redirect('/admin/race/index/');
            }
        }

        $this->getView()->addVar('data', $data);
    }

    public function createTmp()
    {
        Layout::setLayout('admin');
        $data = array(
            'name' => '',
            'category_id' => '',
            'group_id' => '',
            'type_id' => '',
            'piste_id' => '',
            'hippodrome_id' => '',
            'lenght' => '',
            'corde' => '',
            'race_date' => '',
            'price' => '',
            'recul_gain' => '',
            'recul_meter' => '',
            'max_gain' => '',
            'age_min' => '',
            'age_max' => '',
            'victory_price' => '',
            'status' => '',
            'meeting' => '',
            'sexe' => '',
        );

        if( Request::getInstance()->isPost()){
            $data = Request::getInstance()->getPost();
            $id = Apps::getModel('Race_Tmp')->create($data);
            if( $id ) {
                $this->getView()->redirect('/admin/race/indexTmp/');
            }
        }

        $this->getView()->addVar('data', $data);
    }

    public function edit()
    {
        Layout::setLayout('admin');

        $id = $this->getRequest()->getParam('id');

        $oRace = Apps::getModel('Race')->load($id);
        $data = $oRace->getData();

        $horses = $oRace->getHorsesEngaged();
        $this->getView()->addVar('horses', $horses);

        if( Request::getInstance()->isPost()){
            $data = Request::getInstance()->getPost();
            $id = Apps::getModel('Race')->update($data);
            if( $id ) {
                $this->getView()->redirect('/admin/race/index/');
            }
        }

        $this->getView()->addVar('data', $data);
    }

    public function editTmp()
    {
        Layout::setLayout('admin');

        $id = $this->getRequest()->getParam('id');

        $oRace = Apps::getModel('Race_Tmp')->load($id);
        $data = $oRace->getData();

        $horses = $oRace->getHorsesEngaged();
        $this->getView()->addVar('horses', $horses);

        if( Request::getInstance()->isPost()){
            $data = Request::getInstance()->getPost();
            $id = Apps::getModel('Race_Tmp')->update($data);
            if( $id ) {
                $this->getView()->redirect('/admin/race/indexTmp/');
            }
        }

        $this->getView()->addVar('data', $data);
    }

    public function hippo()
    {
        Layout::setLayout('admin');

        $hippos = Apps::getModel('Race_Hippodrome')->getHippodromes();
        $this->getView()->addVar('hippos', $hippos);
    }

    public function type()
    {
        Layout::setLayout('admin');

        $hippos = Apps::getModel('Race_Type')->getTypes();
        $this->getView()->addVar('hippos', $hippos);
    }
    public function category()
    {
        Layout::setLayout('admin');

        $hippos = Apps::getModel('Race_Category')->getCategories();
        $this->getView()->addVar('hippos', $hippos);
    }
    public function group()
    {
        Layout::setLayout('admin');

        $hippos = Apps::getModel('Race_Group')->getGroups();
        $this->getView()->addVar('hippos', $hippos);
    }
    public function piste()
    {
        Layout::setLayout('admin');

        $hippos = Apps::getModel('Race_Piste')->getPistes();
        $this->getView()->addVar('hippos', $hippos);
    }

    public function validRace()
    {
        $this->setNoRender();
        $race_id = $this->getRequest()->getParam('race_id');
        if($race_id){
            Apps::getModel('Race_Tmp')->validRace($race_id);
        }else{
            $allRaces = Apps::getModel('Race_Tmp')->getAllRaceDay();
            if($allRaces){
                foreach( $allRaces as $race ){
                    Apps::getModel('Race_Tmp')->validRace($race['id']);
                }
            }
        }
        $this->getView()->redirect('/admin/race/indexTmp/');
    }


    public function simulation()
    {
        $this->setNoRender();
        $id = $this->getRequest()->getParam('id');
        Apps::getModel('Race')->simulate($id);
    }
}