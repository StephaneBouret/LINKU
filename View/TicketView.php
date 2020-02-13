<?php 


class TicketView extends View {

    /**
     * Affichage de la liste des tickets
     *
     * @param [type] $listTickets
     * @return void
     */
    public function displayHome($listTickets) {
        // var_dump($listTickets);
            $this->page .="<h1 class='text-center'>LES DEMANDES DE CONTACTS !</h1>";
            foreach ($listTickets as $ticket) {
                $newDate = date("d-m-Y H:i:s", strtotime($ticket['date_debut']));
                // VERSION DESKSTOP
                $this->page .= '<div class="card d-none d-md-block mt-4 mb-4 ">
                <div class="card-header bg-success text-white"><h5>'
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
                $this->page .= '<div class="card d-sm-block d-md-none bg-success text-white mt-4 mb-4">
                <div class="card-header"><h4>'
                .strftime(" %d %m %G", strtotime($ticket['date_debut'])) ."</h4> " .$ticket['prenom'] ." " .$ticket['nom']
                .'</div>
                <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-warning col-1 col-md-4 mr-4"><i class="fas fa-eye"></i></a>
                    <a href="#" class="btn btn-primary col-3">Go somewhere</a>
                </div>
                </div>'; 
            }
           // $this->page .= file_get_contents('template/detail.html');
            $this->displayPage();
        }

        /**
        * Affichage d'un ticket
        *
        * @param [type] $ticket
        * @return void
        */
        public function modal($ticket){
            // var_dump($ticket);
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
            $this->page = str_replace('{numAction}',$ticket['id_action'],$this->page);
            $this->page = str_replace('{descAction}',$ticket['desc_action'],$this->page);
            $this->page = str_replace('{techn}',$ticket['display_name'],$this->page);
            $this->displayPage();
    }
    
}