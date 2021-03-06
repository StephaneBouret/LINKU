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
        $listTickets = $this->model->getTickets();
        $this->view->displayHome($listTickets);
    }

    /**
     * Affichage de la vue du ticket
     *
     * @return void
     */
    public function modal(){
        $ticket = $this->model->getTicket();
        $listActionsByTicket = $this->model->getActionsByTicket();
        $this->view->modal($ticket, $listActionsByTicket);
    }

}