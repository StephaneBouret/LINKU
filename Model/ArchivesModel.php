<?php

class ArchivesModel extends Model
{

    /**
     * Fonction affichage de la BDD archives
     * @return void
     */
    public function getArchives(){
        $requete = "SELECT *, t.id as id_ticket, t.description as desc_ticket, s.description as desc_statut
        FROM linku_ticket as t 
        LEFT JOIN linku_statut as s 
        ON t.id_linku_statut = s.id
        WHERE t.id_linku_statut = 3";
        $result = $this->connexion->query($requete);
        $listArchives = $result->fetchAll(PDO::FETCH_ASSOC);
        return $listArchives;
    }

    /**
     * Fonction affichage d'une donnée de la BDD archives
     *
     * @return void
     */
    public function getArchive(){
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
        $archive = $requete->fetch(PDO::FETCH_ASSOC);
        return $archive;
    }
​
    /**
     * Fonction affichage de la BDD action archivée
     *
     * @return void
     */
    public function getActionsByArchive()
    {
        $requete = "SELECT *, a.id as id_action, t.id as id_ticket, 
        a.description as desc_action, u.ID as id_user
        FROM linku_action as a 
        LEFT JOIN linku_ticket as t 
        ON a.id_linku_ticket = t.id
        LEFT JOIN linku_users as u 
        ON a.id_linku_users = u.ID";
        $result = $this->connexion->query($requete);
        $listActionsByArchive = $result->fetchAll(PDO::FETCH_ASSOC);
        return $listActionsByArchive;
    }


}
