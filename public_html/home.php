<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <title> Tryvlor </title>
        <?=get_head()?>
        <link rel="stylesheet" type="text/css" href="lib/css/styles.css" />
        <link rel="stylesheet" type="text/css" href="lib/css/index.css" />
    </head>
    <body>
        <?=get_header()?>
        <div id="map"></div>
        <script>
            var map;
            function initMap(){
              map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: -17.684854, lng: -51.7346561},
                zoom: 4
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

                    google.maps.event.addListener(markers[i], 'click', function() {
                        map.panTo(this.getPosition());
                        map.setZoom(15);
                    }); 
                    google.maps.event.addListener(markers[i], 'dblclick', function() {
                        window.location.href = "hotel/"+markers[this.id].title;
                    });

                  }
                }, "json");
                 
            }
        </script>


        
        <main>
            <div class="singleContent">
                <h2 class="titleContent">Como Funciona?</h2>
                <div class="littleContent">
                    <p>O Cliente deve escolher a cidade, a data e o estabelecimento em que deseja ficar, <strong>então iremos procurar alguém nas mesmas especificações (cidade, data, estabelecimento) para dividir com você um quarto e esta(s) diária(s) do(s) dia(s) em que permanecerem juntos, reduzindo o custo para ambos.</strong></p>
                    <p>O Valor da diária por noite é o valor que será dividido para ambos os clientes.</p>
                </div>
            </div>

            <!-- Lugares em Destaque -->
            <div class="singleContent">
                <h2 class="titleContent">Lugares em Destaque</h2>
                <div class="highlightsContent">

                    <?php
                        $db = new DB;

                        $sql = $db->con()->prepare("SELECT * FROM try_cities LIMIT 9");
                        $sql->execute();
                        if($sql->rowCount() > 0){
                            while($ftc = $sql->fetchObject()):

                    ?>

                                <div class="itemHighlights">
                                    <a href="city/<?=$ftc->nameCity?>">
                                        <img src="<?=$ftc->photoCity?>" />
                                        <h2 class="nameItem"><?=$ftc->nameCity?></h2>
                                    </a>
                                </div>
                    <?php endwhile; }else {echo "<p>Não há nada para ser exibido.</p>";} ?>
                </div>
            </div>

            <!-- Hotéis em Destaque -->
            <div class="singleContent">
                <h2 class="titleContent" id="hotelsHighlightsTitle">Hotéis em Destaque</h2>
                <div id="hotelsHighlights">
                    <div class="hotelsItems" style="background-image:url(http://tryvlor.com/wp-content/uploads/2016/08/47644240.jpg)">
                        <a href="#">
                            <hgroup>
                                <h3 class="hotelsItemsName">Hotel Astoria Palace</h3>
                                <h5 class="hotelsItemsCity">Rio de Janeiro</h5>
                            </hgroup>
                        </a>
                    </div>

                    <div class="hotelsItems" style="background-image:url(http://tryvlor.com/wp-content/uploads/2016/08/47644240.jpg)">
                        <a href="#">
                            <hgroup>
                                <h3 class="hotelsItemsName">Hotel Astoria Palace</h3>
                                <h5 class="hotelsItemsCity">Rio de Janeiro</h5>
                            </hgroup>
                        </a>
                    </div>

                    <div class="hotelsItems" style="background-image:url(http://tryvlor.com/wp-content/uploads/2016/08/47644240.jpg)">
                        <a href="#">
                            <hgroup>
                                <h3 class="hotelsItemsName">Hotel Astoria Palace</h3>
                                <h5 class="hotelsItemsCity">Rio de Janeiro</h5>
                            </hgroup>
                        </a>
                    </div>

                    <div class="hotelsItems" style="background-image:url(http://tryvlor.com/wp-content/uploads/2016/08/47644240.jpg)">
                        <a href="#">
                            <hgroup>
                                <h3 class="hotelsItemsName">Hotel Astoria Palace</h3>
                                <h5 class="hotelsItemsCity">Rio de Janeiro</h5>
                            </hgroup>
                        </a>
                    </div>

                    <div class="hotelsItems" style="background-image:url(http://tryvlor.com/wp-content/uploads/2016/08/47644240.jpg)">
                        <a href="#">
                            <hgroup>
                                <h3 class="hotelsItemsName">Hotel Astoria Palace</h3>
                                <h5 class="hotelsItemsCity">Rio de Janeiro</h5>
                            </hgroup>
                        </a>
                    </div>

                    <div class="hotelsItems" style="background-image:url(http://tryvlor.com/wp-content/uploads/2016/08/47644240.jpg)">
                        <a href="#">
                            <hgroup>
                                <h3 class="hotelsItemsName">Hotel Astoria Palace</h3>
                                <h5 class="hotelsItemsCity">Rio de Janeiro</h5>
                            </hgroup>
                        </a>
                    </div>
                </div>
            </div>

            <!--  -->
            <div class="singleContent" id="infos">
                <div class="itemInfos">
                    <img src="lib/images/money-icon.png" />
                    <p>Compartilhe um quarto e economize na diária 50%</p>
                </div>
                <div class="itemInfos">
                    <img src="lib/images/sunbed-icon.png" />
                    <p>Curta suas férias em lugares novos ou se hospede a trabalho com mais economia em sua viagem.</p>
                </div>
                <div class="itemInfos">
                    <img src="lib/images/peoples-icon.png" />
                    <p>Conheça novas pessoas em novos lugares e novos estabelecimentos e relaxe.</p>
                </div>
            </div>
        </main>

        <?=get_footer()?>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAbMreoMh0v7ZG6HpnKkXoEv7KbHX5kb1o&callback=initMap"
            async defer></script>
    </body>
</html>
