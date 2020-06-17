<?php

namespace App\Model;

class Asset extends AbstractModel {

    private $id;
    private $title;
    private $value;
    private $area;
    private $rooms;
    private $zipcode;
    private $city;

    private $contacts;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function getArea()
    {
        return $this->area;
    }

    public function setArea($area)
    {
        $this->area = $area;
    }

    public function getRooms()
    {
        return $this->rooms;
    }

    public function setRooms($rooms)
    {
        $this->rooms = $rooms;
    }

    public function getZipcode()
    {
        return $this->zipcode;
    }

    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city)
    {
        $this->city = $city;
    }

    public static function findAll()
    {
        $pdo = self::getPdo();

        $query = 'SELECT * FROM Asset';

        $response = $pdo->prepare($query);
        $response->execute();

        $data = $response->fetchAll();

        // On prépare le tableau qui contiendra nos animaux en format Object
        $dataAsObjects = [];

        // On fait un foreach de $data (données de la bdd) pour transformer chaque data en un object
        // puis on met l'object dans le tableau $dataAsObjects
        foreach ($data as $d) {
            $dataAsObjects[] = self::toObject($d);
        }

        return $dataAsObjects;
    }

    /**
     * Récupère un asset par son id
     */
    public static function findOne($id)
    {
        $pdo = self::getPdo();

        $query = 'SELECT * FROM Asset WHERE id = :id';

        $response = $pdo->prepare($query);
        $response->execute([
            'id' => $id,
        ]);

        $data = $response->fetch();

        $dataAsObject = self::toObject($data);

        return $dataAsObject;
    }
    /**
     * Transforme un array de données de la table Asset en un objet Asset
     */
    public static function toObject($array)
    {

        $asset = new Asset;
        $asset->setId($array['id']);
        $asset->setTitle($array['title']);
        $asset->setValue($array['value']);
        $asset->setArea($array['area']);
        $asset->setRooms($array['rooms']);
        $asset->setZipcode($array['zipcode']);
        $asset->setCity($array['city']);

        return $asset;
    }

    /**
     * Enregistre l'objet lui-même en base de données
     */
    public function store()
    {

        $pdo = self::getPdo();

        $query = 'INSERT INTO Asset(title, value, area, rooms, zipcode, city) VALUES (:title, :value, :area, :rooms, :zipcode, :city)';

        $response = $pdo->prepare($query);
        $response->execute([
            'title' => $this->getTitle(),
            'value' => $this->getValue(),
            'area' => $this->getArea(),
            'rooms' => $this->getRooms(),
            'zipcode' => $this->getZipcode(),
            'city' => $this->getCity(),
        ]);

        return true;
    }

    public function getContacts() {

        $pdo = self::getPdo();

        $query = 'SELECT * FROM Contact WHERE asset_id = :id';

        $response = $pdo->prepare($query);
        $response->execute(['id' => $this->getId()]);

        $data = $response->fetchAll();

        $dataAsObjects = [];
        foreach ($data as $d) {
            $dataAsObjects[] = Contact::toObject($d);
        }

        return $dataAsObjects;
    }
}