<?php

include 'View/TicketView.php';
include 'Model/TicketModel.php';

class TicketController extends Controller {

        /**
     * Mise en place de la connexion vers la DB
     * @return void
     */

    public function __construct()
    {
      $this->view = new TicketView();
      $this->model = new TicketModel();
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