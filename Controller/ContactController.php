<?php

include 'View/ContactView.php';
include 'Model/ContactModel.php';

class ContactController extends Controller {

        /**
     * Mise en place de la connexion vers la DB
     * @return void
     */

    public function __construct()
    {
      $this->view = new ContactView();
      $this->model = new ContactModel();
    }

        /**
     * Affichage de la page d'accueil
     * Liste des infos :
     * 
     * @return void
     */

    public function start() {
       // $listContacts = $this->model->getContact();

        $this->view->displayHome();
    }
/*
    public function addForm() {
        $listContacts = $this->model->getContact();
        $this->view->displayForm($listContacts);
    }
*/

}