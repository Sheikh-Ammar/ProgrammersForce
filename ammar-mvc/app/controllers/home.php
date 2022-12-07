<?php

// HOME CONTROLLER
class Home extends Controller
{
    // SHOW ABOUT PAGE
    public function index()
    {
        $this->view('home');
    }
}
