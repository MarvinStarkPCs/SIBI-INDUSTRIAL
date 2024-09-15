<?php

namespace App\Controllers;


class DadodebajaController extends BaseController
{
    public function index(){
        $session = session();
        if(!$session->has('login')){
            return redirect()->route('/');
        }
    }


}