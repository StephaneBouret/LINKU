<?php
class ActionsView extends View
{

    /**
     * Affichage de la liste des tickets
     *
     * @param [type] $listActions
     * @return void
     */
    public function displayHome($listActions) {
        $this->page .="<h1 class='text-center'>LES ACTIONS !</h1>";
        foreach ($listActions as $actions) {
            var_dump($actions);
            $newDate = date("d-m-Y", strtotime($actions['date']));
            // VERSION DESKSTOP
            $this->page .= '<div class="card d-none d-md-block mt-4 mb-4 ">
            <div class="card-header bg-success text-white"><h5>'
            . $newDate . " " .$actions['desc_action'] ." " .$actions['display_name']
            .'</h5></div>
            <div class="card-body">
                <div class="d-flex">';
                $this->page .= '</div>
                <a href="index.php?controller=ticket&action=modal&id=' . $actions['id_action'] .' "class="btn btn-warning mr-4"><i class="fas fa-eye"></i></a>
            </div></div>';
        //     // VERSION TABLETTE / SMARTPHONE
            $this->page .= '<div class="card d-sm-block d-md-none bg-success text-white mt-4 mb-4">
            <div class="card-header"><h4>'
            .strftime(" %d %m %G", strtotime($actions['date'])) ."</h4> " .$actions['desc_action'] ." " .$actions['display_name']
            .'</div>
            <div class="card-body">
                <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-warning col-1 col-md-4 mr-4"><i class="fas fa-eye"></i></a>
                <a href="#" class="btn btn-primary col-3">Go somewhere</a>
            </div>
            </div>';
            // VERSION TABLETTE / SMARTPHONE
           $this->page .= '<div class="card d-sm-block d-md-none mt-4 mb-4">';
            $statut = '<div class="card-header"><h4>';
            if ($ticket['id_linku_statut'] == 3) { 
                $statut = '<div class="card-header bg-success text-white"><h4>';
            }
            $this->page .= $statut;
            $this->page .= strftime(" %d %m %G", strtotime($ticket['date_debut'])) ."</h4> " .$ticket['prenom'] ." " .$ticket['nom']
            .'</div>
            <div class="card-body">
                <h5 class="card-title">Sujet : ' . $ticket['sujet'] .'</h5>
                <p class="card-text">'.mb_strimwidth($ticket['desc_ticket'], 0, 60, "[...]").'</p>
                <a href="index.php?controller=ticket&action=modal&id=' . $ticket['id_ticket'] .' "class="btn btn-warning col-12 mr-4"><i class="fas fa-eye"></i></a>
            </div>
            </div>';  
        }
       // $this->page .= file_get_contents('template/detail.html');
        $this->displayPage();
    }

    /**
     * Affichage du formulaire de saisie d'une nouvelle action
     *
     * @return void
     */
    public function addForm($listActions, $listUsers, $ticketById)
    {
        $this->page .= "<h1>Ajout d'une action</h1>";
        $this->page .= file_get_contents('template/formAction.html');
        $this->page = str_replace('{action}','addDB&id='.$ticketById['id'].'&id_statut='.$ticketById['id_linku_statut'].'',$this->page);
        $this->page = str_replace('{id}','',$this->page);
        $this->page = str_replace('{description}','',$this->page);
        $technicians = "";
        foreach ($listUsers as $usr) {
            $technicians .= "<option value='" . $usr['id_users'] . "'>" . $usr['display_name'] ."</option>";
        }
        $this->page = str_replace('{intervenant}', $technicians,$this->page);
        $this->page = str_replace('{ticket}', $ticketById['id_ticket'],$this->page);
        $this->displayPage();
    }

}
