<?php
	require_once('DB.class.php');

	class Hotel extends DB{
		public function clearStr($str) {
	        $str = preg_replace('/[áàãâä]/ui', 'a', $str);
	        $str = preg_replace('/[éèêë]/ui', 'e', $str);
	        $str = preg_replace('/[íìîï]/ui', 'i', $str);
	        $str = preg_replace('/[óòõôö]/ui', 'o', $str);
	        $str = preg_replace('/[úùûü]/ui', 'u', $str);
	        $str = preg_replace('/[ç]/ui', 'c', $str);
	        // $str = preg_replace('/[,(),;:|!"#$%&/=?~^><ªº-]/', '_', $str);
	        $str = preg_replace('/[^a-z0-9]/i', '_', $str);
	        $str = preg_replace('/_+/', '_', $str); // ideia do Bacco :)
	        return $str;
		}

		public function getPhotos($IdHotel, $Qntd = null){
			$Qntd = (!empty($Qntd)) ? "LIMIT {$Qntd}" : "";

			$sql = DB::con()->prepare("SELECT idHotel, urlImage FROM try_hotels_images WHERE idHotel = ? {$Qntd}");
			$sql->execute(array($IdHotel));

			return $sql;
		}

		public function getComodities($idHotel){
			$html = "";
			#Obtém as comodidades registradas no id do hotel.
			$sql = DB::con()->prepare("SELECT idHotel, comoditie FROM try_hotels_comodities WHERE idHotel = ?");
			$sql->execute(array($idHotel));

			#Laço com outro select na tabela try_comodities_list para pegar informações
			while($ftc = $sql->fetchObject()){
				$sqlC = DB::con()->prepare("SELECT * FROM try_comodities_list WHERE idComoditie = ? ORDER BY nameComoditie");
				$sqlC->execute(array($ftc->comoditie));
				while($comoditie = $sqlC->fetchObject()){
					$html .= "<li class='comodities'>";
						$html .= "<i class='fa {$comoditie->iconComoditie}' aria-hidden='true'></i>{$comoditie->nameComoditie}";
					$html .= "</li>";
				}
			}
			return $html;
		}

		public function getStarsMedia($idHotel){
			$html = "";
			$sql = DB::con()->prepare("SELECT hotelEvaluation, AVG(stars), ipEvaluation FROM try_hotels_evaluations WHERE hotelEvaluation = ?");
			$sql->execute(array($idHotel));

			$i = 0;
			if($sql->rowCount() > 0){
				$mediaStars = $sql->fetchAll();
				$mediaStars = (int) $mediaStars[0]['AVG(stars)'];
				while($i < $mediaStars){
					$html .= "<i class='fa fa-star'></i>";
					$i++;
				}
			}
			return $html;
		}

	}
