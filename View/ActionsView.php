<?php
class ActionsView extends View
{

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
