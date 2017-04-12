<?php
  #Comente a próxima linha para exibir os erros
  #error_reporting(0);

  require_once("application/class/Pg.class.php");
  require_once("application/class/Hotel.class.php");
  require_once("application/functions/Includes.php");
  $pg = new Pg((isset($_GET['pg'])) ? addslashes(strip_tags($_GET['pg'])) : "");

?>
