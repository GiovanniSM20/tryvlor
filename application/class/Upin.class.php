<?php

/* Developer: Upin, Scriptadores Data: 01/10/2016 Versão: 1.0.0 */

require_once("Config.class.php");

class Upin extends Config
{
	public $path, $fileName, $maxSixe, $ext, $req, $newName, $newExt; //Var to Upload files
	public $oldName, $otherName, $callback; //Var to other methods
	public $res, $json = array(); //responses
	public $err; //var to Log
	public $root;
	
    function __construct(){
		parent::hideErr();
		$this->root = parent::path();
	}
	
	//Methods Upload Files
	public function get($path = NULL, $fileName = NULL, $maxSixe = 5000, $ext = NULL, $req = NULL, $newName = 0, $newExt = NULL){
		if($path == NULL){
			parent::output("GET function failed - parameter 1 is NULL");
		}elseif($fileName == NULL){
			parent::output("GET function failed - parameter 2 is NULL");
		}elseif(!is_int($maxSixe)){
			parent::output("GET function failed - parameter 3 isn't INT");
		}elseif($ext == NULL){
			parent::output("GET function failed - parameter 4 is NULL");
		}elseif($req == NULL){
			parent::output("GET function failed - parameter 5 is NULL");
		}else{
			$this->path = $path;
			$this->fileName = $fileName;
			$this->maxSixe = $maxSixe;
			$this->ext = $ext;
			$this->req = $req;
			$this->newName = $newName;
			$this->newExt = $newExt;
		}
	}
	
	public function run(){
		foreach($_FILES[$this->req]["name"] as $files => $key){
		  $files_perm = explode(",", $this->ext);
		  $size = number_format($_FILES[$this->req]["size"][$files] / 1048576, 2);
		  $ext = $_FILES[$this->req]["name"][$files];
		  $ext = explode(".", $ext);
		  $ext = strtolower(end($ext));
		  
		  #set arr json
		  $json = array();
		  
		  if(empty($_FILES[$this->req]["name"][$files])){
			  parent::output("Nenhuma imagem selecionada.");
		  }else{
			  if(!in_array($ext, $files_perm)){
				parent::output("Extensão inválida - ({$ext})"); //Fatal error: show one for one, for more use "echo"
			  }else{
				if($size > $this->maxSixe){
				  parent::output("Limite de tamanho excedido - max({$this->maxSixe}MB)");
				}else{
					if($this->newName == 1){
						//Do upload with newName
						$this->fileName = date("Yis").rand(9999, 999999);
						
						if(empty($this->newExt)){
							$ext = ".".$ext;
						}else{
							$ext = ".".$this->newExt;
						}
						
						move_uploaded_file($_FILES[$this->req]["tmp_name"][$files], $this->path.$this->fileName.$ext);
						$this->res = TRUE;
						$this->json[] = $this->fileName.$ext;
					}elseif($this->newName == 0){
						//normal upload
						move_uploaded_file($_FILES[$this->req]["tmp_name"][$files], $this->path.$this->fileName[$files]);
						$this->res = TRUE;
						$this->json[] = $this->fileName[$files];
					}else{
						parent::output("An erro ocurred - int. '{$this->newName}' doesn't exists"); //Case the int for different 0 or 1
					}
				}
			  }
			}
		}
	}
	
	//Method to Rename file or directory
	public function toRename($oldName = NULL, $newName = NULL){
		if($oldName == NULL){
			parent::output("Rename function failed - parameter 1 is NULL");
		}elseif($newName == NULL){
			parent::output("Rename function failed - parameter 2 is NULL");
		}else{
			$this->oldName = $oldName;
			$this->otherName = $newName;
			
			if(file_exists($this->oldName)){
				$rename = rename($this->oldName, $this->otherName);
				
				if($rename == TRUE){
					$this->res = TRUE;
				}else{
					$this->res = FALSE;
				}
			}else{
				parent::output("O arquivo informado não existe.");
			}

		}
	}
	
	//Method to remove file
	public function deleteFile($file = NULL){
		if(empty($file)){
			parent::output("deleteFile function failed - parameter 1 is NULL");
		}else{
			if(file_exists($file)){
				$file_to_delete = unlink($file);
				if($file_to_delete == TRUE){
					$this->res = TRUE;
				}else{
					$this->res = FALSE;
				}
			}else{
				parent::output("Arquivo inválido");
			}
		}
	}
	
	//Method to create logs
	public function createLog($path = NULL, $err = NULL){
		if($path == NULL){
			parent::output("createLog function failed - parameter 1 is NULL");
		}elseif($err == NULL){
			parent::output("createLog function failed - parameter 2 is NULL");
		}else{
			$this->path = $path;
			$this->err = $err;
			
			$fileOpen = fopen($this->path, "a") or output("Erro ao abrir arquivo");
			$content = $err."\r\n";
			$writeLog = fwrite($fileOpen, $content, strlen($content));
			
			if($writeLog == TRUE){
				$this->res = TRUE;
			}else{
				$this->res = FALSE;
			}
		}
	}
}

?>