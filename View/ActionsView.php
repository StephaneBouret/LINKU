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
            // var_dump($actions);
            $newDate = date("d-m-Y", strtotime($actions['date']));
            $this->page .= "
            <div class='list-group-item d-flex bg-dark text-white justify-content-between'>
                <h6 class='col-5 mt-2 text-left'> Date: " .date("d-m-Y", strtotime($actions['date'])) ."</h6>
                <h6 class='col-7 mt-2 text-left'> Intervenant : " .$actions['display_name'] ."</h6>
            </div>
                <div class='list-group-item d-flex justify-content-around'>
                    <h5 class='col-md-3 col-sm-5 mt-2'> Action N° " .$actions['id_action'] ."</h5>
                        <p class='col-7 d-none d-lg-block d-xl-block d-md-block'>" .mb_strimwidth($actions['desc_action'], 0, 30, "[...]") .'</p>
                <a href="index.php?controller=actions&action=modal&id=' . $actions['id_action'] .' "class="btn btn-warning mr-4 col-sm-4 col-md-1"><i class="fas fa-eye"></i></a>
            </div>';
        }
       // $this->page .= file_get_contents('template/detail.html');
        $this->displayPage();
    }

            /**
        * Affichage d'une action
        *
        * @param [type] $ticket,$listActionsByTicket
        * @return void
        */
        public function modal($action){
            // var_dump($action);
            $actionDate = date("d-m-Y", strtotime($action['date']));
            $this->page .= file_get_contents('template/detailAction.html');
            $this->page = str_replace('{numTicket}',$action['id_action'],$this->page);
            $this->page = str_replace('{description}',$action['desc_action'],$this->page);
            $this->page = str_replace('{date}',$actionDate,$this->page);
            $this->page = str_replace('{technician}',$action['display_name'],$this->page);
            $this->page = str_replace('{idAction}', $action['id_action'],$this->page);
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

            /**
     * Affichage du formulaire contenant l'information action à modifier
     *
     * @param [type] $action
     * @return void
     */
    public function updateForm($action){
        // var_dump($action);
        $this->page .= "<h1>Modification d'une action</h1>";
        $this->page .= file_get_contents('template/formActionUpdate.html');
        $this->page = str_replace('{action}','updateActionDB&id='.$action['id_ticket'].'',$this->page);
        $this->page = str_replace('{id}',$action['id_action'],$this->page);
        $this->page = str_replace('{date}',$action['date'],$this->page);
        $this->page = str_replace('{technician}',$action['display_name'],$this->page);
        $this->page = str_replace('{description}', $action['desc_action'],$this->page);
        $this->displayPage();
    }

}
