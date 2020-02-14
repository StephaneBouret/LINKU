<?php
class ArchivesView extends View
{

    /**
     * Affichage de la liste des archives
     *
     * @param [type] $listArchives
     * @return void
     */
    public function displayHome($listArchives) {
        $this->page .="<h1 class='text-center'>LES ARCHIVES</h1>";
            foreach ($listArchives as $archive) {
                $newDate = date("d-m-Y H:i:s", strtotime($archive['date_debut']));
                // VERSION DESKSTOP
                $this->page .= '<div class="card d-none d-md-block mt-4 mb-4 ">
                <div class="card-header bg-success text-white"><h5>'
                . $newDate ." " .$archive['prenom'] ." " .$archive['nom']
                .'</h5></div>
                <div class="card-body">
                <div class="d-flex"> 
                <h5 class="card-title">Sujet : ' . $archive['sujet'] .'</h5>';
                $actif = "<p class='text-center col-1 mt-1 text-success'><i class='fas fa-circle'></i></p>";
                if ($archive['id_linku_statut'] == 1) {
                    $actif = "<p class='text-center col-1 mt-1 text-danger'><i class='fas fa-circle'></i></p>";
                } elseif ($archive['id_linku_statut'] == 2) {
                    $actif = "<p class='text-center col-1 mt-1 text-warning'><i class='fas fa-circle'></i></p>";
                }
                $this->page .= $actif;
                $this->page .= '</div>
                <p class="card-text">'.mb_strimwidth($archive['desc_ticket'], 0, 60, "[...]").'</p>
                <a href="index.php?controller=ticket&action=modal&id=' . $archive['id_ticket'] .' "class="btn btn-warning mr-4"><i class="fas fa-eye"></i></a>
                </div></div>';
            }
            $this->displayPage();
        }
    }