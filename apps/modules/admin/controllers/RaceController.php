<?php
class RaceController extends Controller
{

    public function index()
    {
        Layout::setLayout('admin');

        $races = Apps::getModel('Race')->getRaces();
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
            'race_number' => '',
        );

        if( Request::getInstance()->isPost()){
            $data = Request::getInstance()->getPost();
            $id = Apps::getModel('Race')->create($data);
            if( $id ) {
                $this->getView()->redirect('/admin/race/');
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

        $oRace = Apps::getModel('Race')->load($id);
        $data = $oRace->getData();

        $horses = $oRace->getHorsesEngaged();
        $this->getView()->addVar('horses', $horses);

        if( Request::getInstance()->isPost()){
            $data = Request::getInstance()->getPost();
            $id = Apps::getModel('Race')->update($data);
            if( $id ) {
                $this->getView()->redirect('/admin/race/');
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
}