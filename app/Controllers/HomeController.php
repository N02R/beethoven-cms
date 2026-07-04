<?php

class HomeController extends Controller
{
    public function index()
    {
        $page = new Page();

        $hero = $page->find('home_hero');

        return $this->view('pages/home', [
            'hero' => $hero
        ]);
    }
}