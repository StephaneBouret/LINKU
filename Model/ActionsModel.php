<?php

class ActionsModel extends Model
{

    /**
     * Fonction affichage de la table action
     *
     * @return void
     */
    public function getActions()
    {
        $requete = "SELECT *, a.id as id_action, t.id as id_ticket, 
        a.description as desc_action, u.ID as id_user
        FROM linku_action as a 
        LEFT JOIN linku_ticket as t 
        ON a.id_linku_ticket = t.id
        LEFT JOIN linku_users as u 
        ON a.id_linku_users = u.ID";
        $result = $this->connexion->query($requete);
        $listActions = $result->fetchAll(PDO::FETCH_ASSOC);
        return $listActions;
    }

    /**
     * Fonction affichage de la table users
     *
     * @return void
     */
    public function getUsers()
    {
        $requete = "SELECT *, u.ID as id_users
        FROM linku_users as u";
        $result = $this->connexion->query($requete);
        $listUsers = $result->fetchAll(PDO::FETCH_ASSOC);
        return $listUsers;
    }

    /**
     * Fonction affichage d'une donnée de la BDD ticket
     *
     * @return void
     */
    public function getTicketById(){
        $id = $_GET['id'];
        $requete = $this->connexion->prepare("SELECT *, t.id as id_ticket, t.description as desc_ticket
        FROM linku_ticket as t 
        WHERE t.id = :id");
        $requete->bindParam(':id', $id);
        $result = $requete->execute();
        $ticketById = $requete->fetch(PDO::FETCH_ASSOC);
        return $ticketById;
    }

    /**
     * Fonction ajout de donnée dans la table actions
     *
     * @return void
     */
    public function addDB()
    {
        // insert l'info
        $description = $_POST['description'];
        $ville = $_POST['ville'];
        $technician = $_POST['intervenant'];
        $ticket = $_POST['ticket'];
        $dateAjout = $_POST['dateAjout'];
        if (empty($dateAjout)){
            $dateAjout=NOW();
        }

        $requete = $this->connexion->prepare("INSERT INTO linku_action
        VALUES (NULL, :description, :date, :id_linku_ticket, :id_linku_users)");
        $requete->bindParam(':description', $description);
        $requete->bindParam(':date', $dateAjout);
        $requete->bindParam(':id_linku_ticket', $ticket);
        $requete->bindParam(':id_linku_users', $technician);
        $result = $requete->execute();
        // var_dump($result);
        // var_dump($requete->errorInfo());
    }

}
