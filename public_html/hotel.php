<?php
    $Hotel = new Hotel;

    $db = new DB;
    $nameHotel = (isset($pg[1])) ? addslashes(strip_tags($pg[1])) : "";
    if(empty($nameHotel)){
        header("Location ../404");
    }
    $sql = $db->con()->prepare("SELECT * FROM try_hotels WHERE nameHotel = ? LIMIT 1");
    $sql->execute(array($nameHotel));
    if($sql->rowCount() == 0){
        header("Location ../404");
        exit;
    }

    $HotelInfos = $sql->fetchObject();

    $idHotel = $HotelInfos->idHotel;

    $comodities = $Hotel->getComodities($idHotel);

?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <title> Tryvlor -  <?=$HotelInfos->nameHotel?></title>
        <?=get_head()?>
        <link rel="stylesheet" type="text/css" href="lib/css/styles.css" />
        <link rel="stylesheet" href="lib/css/swiper.min.css" />
        <link rel="stylesheet" href="lib/css/toastr.css" />
        <link rel="stylesheet" type="text/css" href="lib/css/hotel.css" />
    </head>
    <body data-idh="<?=$idHotel?>">
        <?=get_header()?>
        
        <div id="map"></div>
        <script>
            var map;
            function initMap(){
              map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: <?=$HotelInfos->latHotel?>, lng: <?=$HotelInfos->lngHotel?>},
                zoom: 18
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
            <div id="slide-container" class="swiper-container">
                <div class="swiper-wrapper">
                    <?php
                        $sql = $db->con()->prepare("SELECT * FROM try_hotels_images WHERE idHotel = ?");
                        $sql->execute(array($idHotel));
                        if($sql->rowCount() > 0){
                            while($photos = $sql->fetchObject()):
                    ?>
                    <div class="swiper-slide"><img src="<?=$photos->urlImage?>" /></div>
                <?php endwhile; }?>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
            <div id="hotelBox">
                <div id="starsMedia">
                    <?=$Hotel->getStarsMedia($idHotel);?>
                </div>
                <h1><?=$HotelInfos->nameHotel?></h1>
                <article id="description"><?=$HotelInfos->descriptionHotel?></article>

                <div id="cardsAccepted">
                <?php
                    $sql = $db->con()->prepare("SELECT idHotel, card FROM try_hotels_cards WHERE idHotel = ?");
                    $sql->execute(array($idHotel));
                    if($sql->rowCount() > 0):
                        while($card = $sql->fetchObject()):
                            $c = strtolower($card->card);
                ?>
                        <img src="lib/images/Cards/<?=$c?>.png" alt="<?=$card->card?>" />
                <?php
                    endwhile; endif;
                ?>
                </div>

            </div>
            <div class="clear"></div>
            <div id="comodities">
                <ul>
                    <?=$comodities?>
                </ul>
            </div>
            <div class="clear"></div>
            <div id="bomsaber">
                <h1>Bom Saber</h1>
                <article><?=$HotelInfos->bomsaber?></article>
            </div>


            <?php
                $sql = $db->con()->prepare("SELECT hotelEvaluation, ipEvaluation FROM try_hotels_evaluations WHERE hotelEvaluation = :hotelEvaluation AND ipEvaluation = :ipEvaluation");
                $sql->bindValue("hotelEvaluation", $idHotel);
                $sql->bindValue("ipEvaluation", $_SERVER["REMOTE_ADDR"]);
                $sql->execute();
                    if($sql->rowCount() == 0):
                ?>
                <div id="evaluation">
                    <input type="radio" class="voteButton" id="cm_star-empty" name="fb" value="" checked/>
                    <label for="cm_star-1"><i class="fa"></i></label>
                    <input type="radio" class="voteButton" id="cm_star-1" name="fb" value="1"/>
                    <label for="cm_star-2"><i class="fa"></i></label>
                    <input type="radio" class="voteButton" id="cm_star-2" name="fb" value="2"/>
                    <label for="cm_star-3"><i class="fa"></i></label>
                    <input type="radio" class="voteButton" id="cm_star-3" name="fb" value="3"/>
                    <label for="cm_star-4"><i class="fa"></i></label>
                    <input type="radio" class="voteButton" id="cm_star-4" name="fb" value="4"/>
                    <label for="cm_star-5"><i class="fa"></i></label>
                    <input type="radio" class="voteButton" id="cm_star-5" name="fb" value="5"/>
                </div>
            <?php endif; ?>

        </main>
        <div class="clear"></div>
        <?=get_footer()?>
        <script src="lib/js/swiper.jquery.min.js"></script>
        <script src="lib/js/toastr.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAbMreoMh0v7ZG6HpnKkXoEv7KbHX5kb1o&callback=initMap"
            async defer></script>
        <script src="lib/js/hotel.js"></script>
    </body>
</html>
