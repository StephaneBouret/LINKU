<?php

abstract class View {

/**
* Gestion de l'affichage du head de la page
* @return void
*/

protected $page;

public function __construct(){
$this->page = file_get_contents('template/head.html');
$this->page .= file_get_contents('template/nav.html');

if(!isset($_GET['controller'])){
    $_GET['controller'] = "ticket";
}

if ($_GET['controller'] == "ticket") {
    $this->page = str_replace('{activeTic}','active',$this->page);
}
if ($_GET['controller'] == "actions"){
    $this->page = str_replace('{activeAct}','active',$this->page);
}
if ($_GET['controller'] == "archives"){
    $this->page = str_replace('{activeArc}','active',$this->page);
}
if ($_GET['controller'] == "technicians"){
    $this->page = str_replace('{activeInt}','active',$this->page);
}

}


/**
* Gestion de l'affichage du footer
* @return void
*/

protected function displayPage() {
$this->page .= file_get_contents('template/footer.html');
echo $this->page;
}

}