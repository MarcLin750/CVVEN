<?php

namespace App\Controllers;

class AdminController extends BaseController
{
    public function admin()
    {


        return view('admin');
    }
    public function do_login(){
        $admin_name=$this->request->getPost('admin_name');
        $admin_pass=$this->request->getPost('admin_pass');
    }

}
