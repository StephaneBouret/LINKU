<?php 


class TicketView extends View {

    /**
     * Affichage de la liste des tickets
     *
     * @param [type] $listTickets
     * @return void
     */
    public function displayHome($listTickets) {
        var_dump($listTickets);
            $this->page .="<h1 class='text-center'>LES DEMANDES DE CONTACTS !</h1>";
            $this->page .= "<table class='table text-center col p-2 mt-4 mb-4'>";
            $this->page .= "<thead class='thead-light'><th>Date</th><th>Nom</th><th>Prénom</th><th>E-Mail</th><th>Sujet</th><th>Message</th><th>Voir</th><th>Statut</th></thead>";
         /*   foreach ($listUsers as $users) {
                $this->page .= "<tr><td>" .$users['username'] 
                ."</td><td class=''>" .$users['password']
                ."</td><td class=''>" .$users['firstname']
                ."</td><td class=''>" .$users['lastname']
                ."</td><td><a class='btn btn-danger' href='index.php?controller=user&action=suppDB&id="
                .$users['id']
                ."'><i class='fas fa-trash-alt'></i></a></td><td><a class='btn btn-primary' href='index.php?controller=user&action=updateForm&id="
                .$users['id']
            ."'><i class='fas fa-edit'></i></a></td></tr>";
            }
        */
            $this->page .= "</table>";
           // $this->page .= file_get_contents('template/detail.html');
            $this->displayPage();
    }


}