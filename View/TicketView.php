<?php 


class TicketView extends View {

    /**
     * Affichage de la liste des tickets
     *
     * @param [type] $listTickets
     * @return void
     */
    public function displayHome($listTickets) {
            $this->page .="<h1 class='text-center'>LES DEMANDES DE CONTACTS !</h1>";
            foreach ($listTickets as $ticket) {
                $newDate = date("d-m-Y H:i:s", strtotime($ticket['date_debut']));
                // VERSION DESKSTOP
                $this->page .= '<div class="card d-none d-md-block mt-4 mb-4">
                <div class="card-header bg-dark text-white"><h5>'
                . $newDate ." " .$ticket['prenom'] ." " .$ticket['nom']
                .'</h5></div>
                <div class="card-body">
                    <div class="d-flex"> 
                    <h5 class="card-title">Sujet : ' . $ticket['sujet'] .'</h5>';
                    $actif = "<p class='text-center col-1 mt-1 text-success'><i class='fas fa-circle'></i></p>";
                    if ($ticket['id_linku_statut'] == 1) {
                        $actif = "<p class='text-center col-1 mt-1 text-danger'><i class='fas fa-circle'></i></p>";
                    } elseif ($ticket['id_linku_statut'] == 2) {
                        $actif = "<p class='text-center col-1 mt-1 text-warning'><i class='fas fa-circle'></i></p>";
                    }
                    $this->page .= $actif;
                    $this->page .= '</div>
                    <p class="card-text">'.mb_strimwidth($ticket['desc_ticket'], 0, 60, "[...]").'</p>
                    <a href="index.php?controller=ticket&action=modal&id=' . $ticket['id_ticket'] .' "class="btn btn-warning mr-4"><i class="fas fa-eye"></i></a>
                </div></div>';

            // VERSION TABLETTE / SMARTPHONE
            $this->page .= '<div class="card d-sm-block d-md-none mt-4 mb-4">';
            $statut = '<div class="card-header"><h4>';
            if ($ticket['id_linku_statut'] == 1) { 
                $statut = '<div class="card-header bg-danger text-white"><h4>';
            } elseif ($ticket['id_linku_statut'] == 2){
                $statut = '<div class="card-header bg-warning text-white"><h4>';
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
            $this->displayPage();
        }

        /**
        * Affichage d'un ticket
        *
        * @param [type] $ticket,$listActionsByTicket
        * @return void
        */
        public function modal($ticket,$listActionsByTicket){
            $actionDate = date("d-m-Y", strtotime($ticket['date']));
            $this->page .= file_get_contents('template/detail.html');
            $this->page = str_replace('{numTicket}',$ticket['id_ticket'],$this->page);
            $this->page = str_replace('{nom}',$ticket['nom'],$this->page);
            $this->page = str_replace('{prenom}',$ticket['prenom'],$this->page);
            $this->page = str_replace('{email}',$ticket['email'],$this->page);
            $this->page = str_replace('{tel}',$ticket['tel'],$this->page);
            $this->page = str_replace('{sujet}',$ticket['sujet'],$this->page);
            $this->page = str_replace('{categorie}',$ticket['categories'],$this->page);
            $this->page = str_replace('{statut}',$ticket['desc_statut'],$this->page);
            $this->page = str_replace('{message}',$ticket['desc_ticket'],$this->page);
            $background = "";
            if ($ticket['desc_statut'] == "Non traité"){
                $background = "bg-danger";
            } elseif ($ticket['desc_statut'] == "En cours de traitement"){
                $background = "bg-warning";
            } elseif ($ticket['desc_statut'] == "Traité"){
                $background = "bg-success";
            };
            $this->page = str_replace('{background}',$background,$this->page);
            $actions = "";
            foreach ($listActionsByTicket as $actionsByTicket) {
                if ($ticket['id_ticket'] == $actionsByTicket['id_ticket']){
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
            $this->page = str_replace('{idTicket}', $ticket['id_ticket'],$this->page);
            $this->displayPage();
    }
    
}