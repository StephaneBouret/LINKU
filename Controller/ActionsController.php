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
        $this->model->updateDB();
        $this->model->addDB();
        header('location:index.php?controller=ticket');
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