<?php
  class DB{
    private $host = 'localhost';
    private $db = 'tryvlor';
    private $user = 'root';
    private $pass = '';

    public function con(){
      try{
        return new PDO("mysql:host={$this->host};dbname={$this->db};charset=utf8", $this->user, $this->pass);
      }catch(PDOException $e){
        return "Houve um erro ao se conectar: ".$e;
      }
    }
  }
