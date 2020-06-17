<?php

namespace App\Controller;

use App\Model\Contact;

class ContactsController extends AbstractController {

    public function new()
    {
        $contact = new Contact;
        $contact->setFirstname($_POST['firstname']);
        $contact->setLastname($_POST['lastname']);
        $contact->setEmail($_POST['email']);
        $contact->setMessage($_POST['message']);
        $contact->setIdAsset($_POST['asset_id']);
        $contact->store();

        return AssetsController::show($_POST['asset_id']);
    }
}