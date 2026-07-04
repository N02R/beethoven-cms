<?php

class HomeController extends controller
{
    public function index()
    {
        return $this->view('pages/home', [
            'title' => 'Beethoven CMS Home'
        ]);
    }
}