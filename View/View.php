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