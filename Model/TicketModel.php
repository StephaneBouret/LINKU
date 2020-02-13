<?php

class TicketModel extends Model
{

    /**
     * Fonction affichage de la BDD ticket
     * @return void
     */
    public function getTickets(){
        $requete = "SELECT *, t.id as id_ticket, t.description as desc_ticket, s.description as desc_statut
        FROM linku_ticket as t 
        LEFT JOIN linku_statut as s 
        ON t.id_linku_statut = s.id
        WHERE t.id_linku_statut = 1 OR t.id_linku_statut = 2";
        $result = $this->connexion->query($requete);
        $listTickets = $result->fetchAll(PDO::FETCH_ASSOC);
        return $listTickets;
    }

}