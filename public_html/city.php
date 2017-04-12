<?php
    $Hotel = new Hotel;
    $db = new DB;
    $city = (isset($pg[1])) ? addslashes(strip_tags($pg[1])) : "";

    $sql = $db->con()->prepare("SELECT * FROM try_cities WHERE nameCity = :city LIMIT 1");
    $sql->bindValue("city", $city);
    $sql->execute();
    $ftc = $sql->fetchObject();
    $nameCity = $ftc->nameCity;
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <title> Tryvlor </title>
        <?=get_head()?>
        <link rel="stylesheet" type="text/css" href="lib/css/styles.css" />
    </head>
    <body>
        <?=get_header()?>

        <div id="map"></div>
        <script>
            var map;
            function initMap(){
              map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: <?=$ftc->latCity?>, lng: <?=$ftc->lngCity?>},
                zoom: 15
              });
              var ajaxPath = "application/functions/ajax.php";

                $.post(ajaxPath, {acc: "getHotelsMap"}, function(data){
                  var res = data.res;

                  var image = 'lib/images/Maps/icon.png';
                  var markers = []; 
                  for(i = 0; i < res.length; i++){

                    markers[i] = new google.maps.Marker({
                      position: {lat: parseFloat(res[i].latHotel), lng: parseFloat(res[i].lngHotel)},
                      draggable: true,
                      animation: google.maps.Animation.DROP,
                      map: map,
                      icon: image,
                      title: res[i].nameHotel,
                      id: i
                    });

                    google.maps.event.addListener(markers[i],'click',function() {
                       window.location.href = "hotel/"+markers[this.id].title;
                    });

                  }
                }, "json");
                
            }
        </script>


        <main>
            <div class="singleContent">
                <h2 class="titleContent" id="hotelsHighlightsTitle">Hotéis em <?=$nameCity?></h2>
                <?php
                    if($sql->rowCount() == 0){
                        echo "Ainda não existem hotéis na cidade solicitada.";
                    }else{
                        $idCity = $ftc->idCity;
                        $sql = $db->con()->prepare("SELECT * FROM try_hotels WHERE idCity = :idCity");
                        $sql->bindValue("idCity", $idCity);
                        $sql->execute();
                        if($sql->rowCount() == 0){
                            echo "Nenhum hotel foi encontrado nesta cidade.";
                        }else{
                            while($ftc = $sql->fetchObject()):
                                $photo = $Hotel->getPhotos($ftc->idHotel, 1)->fetchObject();
                        ?>

                            <div id="hotelsHighlights">
                                <div class="hotelsItems" style="background-image:url(<?=$photo->urlImage?>)">
                                    <a href="hotel/<?=$ftc->nameHotel?>">
                                        <hgroup>
                                            <h3 class="hotelsItemsName"><?=$ftc->nameHotel?></h3>
                                            <h5 class="hotelsItemsCity"><?=$nameCity?></h5>
                                        </hgroup>
                                    </a>
                                </div>
                            </div>

                        <?php
                            endwhile;
                        }
                    }
                ?>
            </div>
        </main>
        <div class="clear"></div>
        <?=get_footer()?>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAbMreoMh0v7ZG6HpnKkXoEv7KbHX5kb1o&callback=initMap"
            async defer></script>
    </body>
</html>
