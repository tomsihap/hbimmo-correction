<?php

namespace App\Controller;

class AppController extends AbstractController
{
    public function index() {
        echo self::getTwig()->render('app/index.html');
    }
}
