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

    /**
     * Fonction affichage d'une donnée de la BDD ticket
     *
     * @return void
     */
    public function getTicket(){
        $id = $_GET['id'];
        $requete = $this->connexion->prepare("SELECT *, t.id as id_ticket, t.description as desc_ticket, 
        s.description as desc_statut, a.description as desc_action,
        a.id as id_action, u.ID as id_user
        FROM linku_ticket as t 
        LEFT JOIN linku_statut as s 
        ON t.id_linku_statut = s.id
        LEFT JOIN linku_action as a 
        ON a.id_linku_ticket = t.id
        LEFT JOIN linku_users as u 
        ON a.id_linku_users = u.ID
        WHERE t.id = :id");
        $requete->bindParam(':id', $id);
        $result = $requete->execute();
        $ticket = $requete->fetch(PDO::FETCH_ASSOC);
        return $ticket;
    }

}