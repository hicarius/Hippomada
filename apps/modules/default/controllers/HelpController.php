<?php

class HelpController extends Controller
{
    public function index()
    {
        Layout::setLayout('index');
        $this->setViewUpdate('stable');

    }

    public function races()
    {
        Layout::setLayout('index');
    }

    public function trainer()
    {
        Layout::setLayout('index');
    }

    public function breedings()
    {
        Layout::setLayout('index');
    }

    public function stable()
    {
        Layout::setLayout('index');
    }

    public function shop()
    {
        Layout::setLayout('index');
    }

    public function jockey()
    {
        Layout::setLayout('index');
    }
}