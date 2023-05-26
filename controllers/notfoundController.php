<?php

class notfoundController extends controller
{
    
    public function index() 
    {
        $data = array();
        $this->templateView('404notfound', $data) ;
    }

}