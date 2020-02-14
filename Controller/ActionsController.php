<?php

include 'Model/ActionsModel.php';
include 'View/ActionsView.php';

class ActionsController extends Controller
{


    public function __construct()
    {
        $this->view = new ActionsView();
        $this->model = new ActionsModel();
    }

        /**
     * Affichage de la page d'accueil
     * Liste des infos :
     * 
     * @return void
     */

    public function start() {
        $listActions = $this->model->getActions();
        $this->view->displayHome($listActions);
    }

        /**
     * Affichage de la vue d'une action
     *
     * @return void
     */
    public function modal(){
        $ticket = $this->model->getTicket();
        $listActionsByTicket = $this->model->getActionsByTicket();
        $this->view->modal($ticket, $listActionsByTicket);
    }

    /**
     * Gestion de l'affichage du formulaire d'ajout d'une action
     *
     * @return void
     */
    public function addForm()
    {
        $listActions = $this->model->getActions();
        $listUsers = $this->model->getUsers();
        $ticketById = $this->model->getTicketById();
        $this->view->addForm($listActions,$listUsers,$ticketById);
    }

    /**
     * Gestion de l'ajout d'une action
     *
     * @return void
     */
    public function addDB()
    {
        $id = $_GET['id'];
        $this->model->updateDB();
        $this->model->addDB();
        header('location:index.php?controller=ticket&action=modal&id='.$id.'');
    }

            /**
     * Gestion de la cloture d'une action
     *
     * @return void
     */
    public function closeForm(){
        $this->model->closeAction();
        header('location:index.php?controller=ticket');
    }

}