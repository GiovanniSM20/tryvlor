<?php

/* Developer: Upin, Scriptadores Data: 01/10/2016 - 1.0.0 */

class Config
{
	public $error = TRUE; 
	
	public function path(){
		return $_SERVER["DOCUMENT_ROOT"]; //directory
	}
	
	public function hideErr(){
		if($this->error == TRUE){
			return error_reporting(0);
		}else{
			//show warnings and messages
		}
	}
	
	public function output($err = NULL){
		if($err == NULL){
			//Don't show
		}else{
			$div = "";
			$div .= "<div class='x-err'>";
			$div .= $err;
			$div .= "</div>";
			
			echo $div;
		}
	}
}
