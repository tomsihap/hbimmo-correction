<?php

namespace App\Model;

class Contact extends AbstractModel {

    private $id;
    private $firstname;
    private $lastname;
    private $email;
    private $message;
    private $idAsset;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function getIdAsset()
    {
        return $this->idAsset;
    }

    public function setIdAsset($idAsset)
    {
        $this->idAsset = $idAsset;
    }

    public static function findAll()
    {
        $pdo = self::getPdo();

        $query = 'SELECT * FROM Contact';

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
     * Récupère un contact par son id
     */
    public static function findOne($id)
    {
        $pdo = self::getPdo();

        $query = 'SELECT * FROM Contact WHERE id = :id';

        $response = $pdo->prepare($query);
        $response->execute([
            'id' => $id,
        ]);

        $data = $response->fetch();

        $dataAsObject = self::toObject($data);

        return $dataAsObject;
    }
    /**
     * Transforme un array de données de la table Contact en un objet Contact
     */
    public static function toObject($array)
    {

        $contact = new Contact;
        $contact->setId($array['id']);
        $contact->setFirstname($array['firstname']);
        $contact->setLastname($array['lastname']);
        $contact->setEmail($array['email']);
        $contact->setMessage($array['message']);
        $contact->setIdAsset($array['asset_id']);

        return $contact;
    }

    /**
     * Enregistre l'objet lui-même en base de données
     */
    public function store()
    {

        $pdo = self::getPdo();

        $query = 'INSERT INTO Contact(firstname, lastname, email, message, asset_id) VALUES (:firstname, :lastname, :email, :message, :asset_id)';

        $response = $pdo->prepare($query);
        $response->execute([
            'firstname' => $this->getFirstname(),
            'lastname' => $this->getLastname(),
            'email' => $this->getEmail(),
            'message' => $this->getMessage(),
            'asset_id' => $this->getIdAsset(),
        ]);

        return true;
    }

}