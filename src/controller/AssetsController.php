<?php

namespace App\Controller;

use App\Model\Asset;

class AssetsController extends AbstractController
{
    public function index() {
        $assets = Asset::findAll();
        echo self::getTwig()->render('assets/index.html', [
            'assets' => $assets
        ]);

    }

    public function create() {
        echo self::getTwig()->render('assets/form.html');

    }

    public function new() {

        $asset = new Asset;
        $asset->setTitle($_POST['title']);
        $asset->setValue($_POST['value']);
        $asset->setArea($_POST['area']);
        $asset->setRooms($_POST['rooms']);
        $asset->setZipcode($_POST['zipcode']);
        $asset->setCity($_POST['city']);
        $asset->store();

        return $this->index();

    }

    public static function show(int $id) {
        $asset = Asset::findOne($id);
        echo self::getTwig()->render('assets/show.html', [
            'asset' => $asset
        ]);
    }
}
