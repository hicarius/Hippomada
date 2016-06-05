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
        $oStable = Apps::getModel('Stable')->load($id);
        $data = $oStable->getData();
        $this->getView()->addVar('stable', $data);

        $horses = $oStable->getHorsesForStable();
        $this->getView()->addVar('horses', $horses);

        if( Request::getInstance()->isPost()){
            $data = Request::getInstance()->getPost();
            $id = $oStable->update($data);
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