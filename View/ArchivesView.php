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
                <div class="card-header bg-dark text-white"><h5>'
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
                <a href="index.php?controller=archives&action=modal&id=' . $archive['id_ticket'] .' "class="btn btn-warning mr-4"><i class="fas fa-eye"></i></a>
                </div></div>';
                                // VERSION TABLETTE / SMARTPHONE
                                $this->page .= '<div class="card d-sm-block d-md-none mt-4 mb-4">';
                                $statut = '<div class="card-header"><h4>';
                                if ($archive['id_linku_statut'] == 3) { 
                                    $statut = '<div class="card-header bg-success text-white"><h4>';
                                }
                                $this->page .= $statut;
                                $this->page .= strftime(" %d %m %G", strtotime($archive['date_debut'])) ."</h4> " .$archive['prenom'] ." " .$archive['nom']
                                .'</div>
                                <div class="card-body">
                                    <h5 class="card-title">Sujet : ' . $archive['sujet'] .'</h5>
                                    <p class="card-text">'.mb_strimwidth($archive['desc_ticket'], 0, 60, "[...]").'</p>
                                    <a href="index.php?controller=ticket&action=modal&id=' . $archive['id_ticket'] .' "class="btn btn-warning col-12 mr-4"><i class="fas fa-eye"></i></a>
                                </div>
                                </div>'; 
            }
            $this->displayPage();
        }

                        /**
        * Affichage d'un ticket archivé
        *
        * @param [type] $archive,$listActionsByArchive
        * @return void
        */
        public function modal($archive,$listActionsByArchive){
            $actionDate = date("d-m-Y", strtotime($archive['date']));
            $this->page .= file_get_contents('template/archiveDetail.html');
            $this->page = str_replace('{numTicket}',$archive['id_ticket'],$this->page);
            $this->page = str_replace('{nom}',$archive['nom'],$this->page);
            $this->page = str_replace('{prenom}',$archive['prenom'],$this->page);
            $this->page = str_replace('{email}',$archive['email'],$this->page);
            $this->page = str_replace('{tel}',$archive['tel'],$this->page);
            $this->page = str_replace('{sujet}',$archive['sujet'],$this->page);
            $this->page = str_replace('{categorie}',$archive['categories'],$this->page);
            $this->page = str_replace('{statut}',$archive['desc_statut'],$this->page);
            $this->page = str_replace('{message}',$archive['desc_ticket'],$this->page);
            $background = "";
            if ($archive['desc_statut'] == "Non traité"){
                $background = "bg-danger";
            } elseif ($archive['desc_statut'] == "En cours de traitement"){
                $background = "bg-warning";
            } elseif ($archive['desc_statut'] == "Traité"){
                $background = "bg-success";
            };
            $this->page = str_replace('{background}',$background,$this->page);
            $actions = "";
            foreach ($listActionsByArchive as $actionsByTicket) {
                if ($archive['id_ticket'] == $actionsByTicket['id_ticket']){
                    $actions .= "
                    <div class='list-group-item d-flex bg-dark text-white justify-content-between'>
                    <h6 class='col-5 mt-2 text-left'> Date: " .date("d-m-Y", strtotime($actionsByTicket['date'])) ."</h6>
                    <h6 class='col-7 mt-2 text-left'> Intervenant : " .$actionsByTicket['display_name'] ."</h6>
                    </div>
                        <div class='list-group-item d-flex justify-content-around'>
                            <h5 class='col-4 mt-2'> Action N° " .$actionsByTicket['id_action'] ."</h5>
                            <p class='col-7'>" .$actionsByTicket['desc_action'] ."</p>
                    </div>";
                }
            }
            $this->page = str_replace('{action}', $actions,$this->page);
            $this->page = str_replace('{idTicket}', $archive['id_ticket'],$this->page);
            $this->displayPage();
    }
    }