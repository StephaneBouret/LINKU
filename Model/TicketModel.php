<?php

class TicketModel extends Model
{

    /**
     * Gestion de la BD dans le tableau
     * @return void
     */
/*
    public function getContact()
    {
        $requete = "SELECT * FROM tickets";
        $result = $this->connexion->query($requete);
        $listContacts = $result->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($listContacts);
        return $listContacts;
    }
*/
    public function show()
    {
       // $new = $this->model->getNew();
        $this->view->show();
    }


}