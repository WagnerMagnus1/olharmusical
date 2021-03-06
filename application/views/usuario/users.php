<div class="section">
  <div class="container">

    <div class="row">
      <div class="col-md-12 text-center"> 
        <div class="col-md-12">
          <h1 class="text-center">Encontre Músicos e Bandas</h1><br>
          <p class="text-center">Aqui você pode localizar músicos e bandas filtrando por função e gênero musical:</p>
          <br>
        </div>           
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <fieldset>
         <label class="control-label">Músicos (AZUL)</label>
          <select class="form-control selectpicker" data-size="7" id="musico" required>
          <option value="" disabled selected>Selecione uma opção</option>
            <?php foreach($funcao as $f) { ?>
                <option value="<?php echo $f['funcao_id']?>"><?php echo $f['funcao_nome']?></option>
            <?php } ?>
            </select><br><br>   
        </fieldset>
      </div>
      <div class="col-md-6">
         <fieldset>
           <label class="control-label">Bandas (VERMELHO)</label>
            <select class="form-control selectpicker" data-size="7" id="bandas" required>
              <option value="" disable selected>Selecione uma opção</option>
              <?php foreach($genero as $f) { ?>
                  <option value="<?php echo $f['genero_id']?>"><?php echo $f['genero_nome']?></option>
              <?php } ?>

              </select><br><br>
          </fieldset>
      </div>
    </div><br><br>
    <div class="row">
      <div class="col-md-12">
        <div id="mapa">
        </div>
      </div>
    </div>
  </div>
</div>
  

<script>
   $('#musico').change(function(event) {
     var dados = {
            funcao : $('#musico').val()
          };

          $.ajax({            
              type: "POST",
              data: { dados: JSON.stringify(dados)},
              datatype: 'json',
              url: "<?php echo site_url('pessoa/get_musicos_funcao_mapa'); ?>",      
              success: function(data){     
                var resultado = JSON.parse(data);
                carregarPontos(resultado);
              },
              error: function(e){
                alert('Busca incompleta, não foi possivel carregar a sua consulta.');
                  console.log(e.message);
              }
          }); 
   });

     $('#bandas').change(function(event) {
     var dados = {
            genero : $('#bandas').val()
          };

          $.ajax({            
              type: "POST",
              data: { dados: JSON.stringify(dados)},
              datatype: 'json',
              url: "<?php echo site_url('banda/get_musicos_funcao_mapa'); ?>",      
              success: function(data){     
                var resultado = JSON.parse(data);
                carregarPontos_Bandas(resultado);
              },
              error: function(e){
                alert('Busca incompleta, não foi possivel carregar a sua consulta.');
                  console.log(e.message);
              }
          }); 
   });
</script>

  <script> 
//Inicia o MAPA
    var map;
    var markers = [];
      function initialize() {
          var latlng = new google.maps.LatLng(-1.8800397, -15.05878999999999);
       
          var options = {
              zoom: 3,
              center: latlng,
              mapTypeId: google.maps.MapTypeId.ROADMAP
          };
          
          map = new google.maps.Map(document.getElementById("mapa"), options);
      }  
      initialize();

//Carrega os pontos no mapa (MUSICOS)
      function carregarPontos(resultado) {
        clear();
        initialize();
          $.each(resultado, function(key, lista) {
             // Parâmetros do texto que será exibido no clique;
                  var contentString = '<img height="70" width="70" alt="Brand" src='+lista.pessoa_foto+'><h2>'+lista.pessoa_nome+'</h2>' +
                  '<p>'+lista.funcao_nome+'</p>' +
                  '<a href='+'<?php echo base_url('pessoa/dados?pessoa_id=');?>'+lista.pessoa_id+'&nome='+lista.pessoa_nome+'>clique aqui para visitar o perfil</a>';
                  var infowindow = new google.maps.InfoWindow({
                      content: contentString
                  })
                 
                  var marker = new google.maps.Marker({
                      position: new google.maps.LatLng(lista.pessoa_latitude,lista.pessoa_longitude),
                      title: lista.pessoa_nome+' '+lista.pessoa_sobrenome,
                      map: map,
                      animation: google.maps.Animation.DROP,
                      icon: '<?php echo base_url('public/imagens/maps/marcador_azul.png')?>'
                  }) 
                  // Exibir texto ao clicar no pin;
                  google.maps.event.addListener(marker, 'click', function() {
                    infowindow.open(map,marker);
                  })
                  markers.push(marker);
          })  
          markerCluster = new MarkerClusterer(map, markers,{
            imagePath: '<?php echo base_url('public/imagens/maps/m')?>'
           })
   
      }

//Carrega os pontos no mapa (BANDAS)
      function carregarPontos_Bandas(resultado) {
        clear();
        initialize();
          $.each(resultado, function(key, lista) {
             // Parâmetros do texto que será exibido no clique;
                  var contentString = '<img height="70" width="70" alt="Brand" src='+lista.banda_foto+'><h2>'+lista.banda_nome+'</h2>' +
                  '<p>'+lista.genero_nome+'</p>' +
                  '<a href='+'<?php echo base_url('banda/dados?banda=');?>'+lista.banda_id+'&pessoa='+<?php echo $pessoa['pessoa_id']?>+'>clique aqui para visitar o perfil</a>';
                  var infowindow = new google.maps.InfoWindow({
                      content: contentString
                  })
                 
                  var marker = new google.maps.Marker({
                      position: new google.maps.LatLng(lista.pessoa_latitude,lista.pessoa_longitude),
                      title: lista.banda_nome,
                      map: map,
                      animation: google.maps.Animation.DROP,
                      icon: '<?php echo base_url('public/imagens/maps/marcador_vermelho.png')?>'
                  }) 
                  // Exibir texto ao clicar no pin;
                  google.maps.event.addListener(marker, 'click', function() {
                    infowindow.open(map,marker);
                  })
                  markers.push(marker);
          })  
          markerCluster = new MarkerClusterer(map, markers,{
            imagePath: '<?php echo base_url('public/imagens/maps/m')?>'
           })
   
      }

//LIMPA OS DADOS DO MAPA
      function clear()
      {
        $.each(markers, function(key, marker){
          marker.setMap(null);
          //markerCluster.set_Map(null);
        }) 

        markers = [];
        //markerCluster = [];
      }

</script>


