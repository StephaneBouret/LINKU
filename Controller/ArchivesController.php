<?php

include 'Model/ArchivesModel.php';
include 'View/ArchivesView.php';

class ArchivesController extends Controller
{


    public function __construct()
    {
        $this->view = new ArchivesView();
        $this->model = new ArchivesModel();
    }
    
    /**
     * Affichage de la page d'accueil
     * Liste des infos :
     * 
     * @return void
     */

    public function start() {
        $listArchives = $this->model->getArchives();
        $this->view->displayHome($listArchives);
    }

    /**
     * Affichage de la vue de l'archive
     *
     * @return void
     */
    public function modal(){
        $archive = $this->model->getArchive();
        $listActionsByArchive = $this->model->getActionsByArchive();
        $this->view->modal($archive, $listActionsByArchive);
    }

}