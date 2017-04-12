<?php
  class Pg{
    public function __construct($pg){
      $pg = (isset($_GET['pg']) AND !empty($_GET['pg'])) ? addslashes(strip_tags($_GET['pg'])) : "home";
      $pg = explode("/",$pg);
      if(file_exists("public_html/$pg[0].php")):
        include("public_html/$pg[0].php");
      else:
        include("public_html/404.php");
      endif;
      return $pg;
    }
  }
