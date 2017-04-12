<?php
	require_once("../class/DB.class.php");

	$db = new DB;

	foreach ($_POST as $key => $value){$_POST[$key] = strip_tags(addslashes($value));}
  	foreach ($_GET as $key => $value){$_GET[$key] = strip_tags(addslashes($value));}

	$acc = (isset($_POST['acc'])) ? $_POST['acc'] : "";
	$pathImages = "../../lib/images/";

	$IP = $_SERVER["REMOTE_ADDR"];

	switch($acc){
		case "getHotelsMap":
			$sql = $db->con()->prepare("SELECT nameHotel, latHotel, lngHotel FROM try_hotels");
			$sql->execute();
			if($sql->rowCount() > 0)
				echo json_encode(array("res"=>$sql->fetchAll()));
		break;


		case "newCity":

			$nameCity = (isset($_POST['nameCity'])) ? $_POST['nameCity'] : "";
			$photoCity = (isset($_FILES['photoCity'])) ? $_FILES['photoCity'] : [];

			if(empty($nameCity) OR count($photoCity) == 0){
				echo "Preencha todos os Campos!";
			}else{
				$extPermitidas = array(".jpg", ".png", ".jpeg");
				$ext = explode(".", $photoCity['name']);
				$ext = ".".strtolower(end($ext));


				if(in_array($ext, $extPermitidas) == false){
					echo "A imagem enviada é inválida (Apenas PNG, JPG são aceitas.)";
					exit;
				}


				$sql = $db->con()->prepare("SELECT nameCity FROM try_cities WHERE nameCity = :nameCity");
				$sql->bindValue("nameCity", $nameCity);
				$sql->execute();
				if($sql->rowCount() > 0){
					echo "Esta cidade já está registrada.";
					exit;
				}


				$photoCityName = str_replace(" ", "-", $nameCity.$ext);

				if(move_uploaded_file($photoCity['tmp_name'], $pathImages."City/".$photoCityName) === true){

					$sql = $db->con()->prepare("INSERT INTO try_cities VALUES (default, :nameCity, :photoCity)");
					$sql->bindValue("nameCity", $nameCity);
					$sql->bindValue("photoCity", "lib/images/".$photoCityName);
					if($sql->execute()){
						echo 1;
						exit;
					}

				}
			}
		break;

		case "voteHotel":
			$idHotel = (isset($_POST['idHotel'])) ? $_POST['idHotel'] : "";
			$evaluation = (int) (isset($_POST['evaluation'])) ? $_POST['evaluation'] : "";

			if(empty($idHotel) OR empty($evaluation))
				die("Não foi possível avaliar este hotel. Atualize a página e tente novamente.");

			$sql = $db->con()->prepare("SELECT hotelEvaluation, ipEvaluation FROM try_hotels_evaluations WHERE hotelEvaluation = ? AND ipEvaluation = ?");
			$sql->execute(array($idHotel, $IP));
			if($sql->rowCount() > 0)
				die("Você já avaliou este hotel.");

			$sql = $db->con()->prepare("INSERT INTO try_hotels_evaluations (hotelEvaluation, stars, ipEvaluation) VALUES (:hotelEvaluation, :stars, :ipEvaluation)");
			$sql->bindValue("hotelEvaluation", $idHotel);
			$sql->bindValue("stars", $evaluation);
			$sql->bindValue("ipEvaluation", $IP);
			if($sql->execute())
				echo 1;
			else
				echo "Não foi possível avaliar este hotel. Atualize a página e tente novamente.";
		break;

		default:
			echo "Algo deu errado no Back-end.";
		break;
	}
