<?php
class StableController extends Controller
{
    public function index()
    {
        Layout::setLayout('admin');

        $stables = Apps::getModel('Stable')->getStables();
        $this->getView()->addVar('stables', $stables);
    }

    public function edit()
    {
        Layout::setLayout('admin');
        $id = $this->getRequest()->getParam('id');
        $data = Apps::getModel('Stable')->load($id);
        $this->getView()->addVar('stable', $data);

        $horses = Apps::getModel('Horse')->getHorsesForStable($id);
        $this->getView()->addVar('horses', $horses);

        if( Request::getInstance()->isPost()){
            $data = Request::getInstance()->getPost();
            $id = Apps::getModel('Stable')->update($data);
            if( $id ) {
                $this->getView()->redirect('/admin/stable/');
            }
        }

        $this->getView()->addVar('post', $data);
    }

    public function create()
    {
        Layout::setLayout('admin');

        $data = array(
            'name' => '',
            'lastname' => '',
            'firstname' => '',
            'email' => '',
            'password' => '',
        );
        if( Request::getInstance()->isPost()){
            $data = Request::getInstance()->getPost();
            $id = Apps::getModel('Stable')->create($data);
            if( $id ) {
                $this->getView()->redirect('/admin/stable/');
            }
        }

        $this->getView()->addVar('post', $data);
    }
}