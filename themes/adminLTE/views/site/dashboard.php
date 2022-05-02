<section class="content-header">
    <h1>Indicador de Mudanza</h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?php echo $ind['pendientes']; ?></h3>
                  <p>Activas</p>
                </div>
                <div class="icon">
                  <i class="fa fa-dot-circle-o"></i>
                </div>
                <a href="<?php echo $this->createUrl('ordenMudanza/?OrdenMudanza[estado]=1') ?>" class="small-box-footer">Mostrar Todos <li class="fa fa-arrow-circle-right"></li></a>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php echo $ind['finalizadas']; ?></h3>
                  <p>Finalizadas</p>
                </div>
                <div class="icon">
                  <i class="fa fa-check"></i>
                </div>
                <a href="<?php echo $this->createUrl('ordenMudanza/?OrdenMudanza[estado]=5') ?>" class="small-box-footer">Mostrar Todos <li class="fa fa-arrow-circle-right"></li></a>
            </div>           
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="small-box bg-red">
                <div class="inner">
                  <h3><?php echo $ind['canceladas']; ?></h3>
                  <p>Canceladas</p>
                </div>
                <div class="icon">
                  <i class="fa fa-ban"></i>
                </div>
                <a href="<?php echo $this->createUrl('ordenMudanza/?OrdenMudanza[estado]=6') ?>" class="small-box-footer">Mostrar Todos <li class="fa fa-arrow-circle-right"></li></a>
            </div>   
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?php echo $ind['inconsistencia']; ?></h3>
                  <p>Inconcistencias</p>
                </div>
                <div class="icon">
                  <i class="fa fa-exclamation"></i>
                </div>
                <a href="<?php echo $this->createUrl('ordenMudanza/?OrdenMudanza[estado]=7') ?>" class="small-box-footer">Mostrar Todos <li class="fa fa-arrow-circle-right"></li></a>
            </div>
        </div>        
    </div>


    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <li class="fa fa-dot-circle-o"></li> <h3 class="box-title">Mudanzas pendientes</h3>
                </div>
                <div class="box-body">
                    <?php 

              $this->widget("ext.yiibooster.widgets.TbGridView",array(
                            "dataProvider"=>$model->search(),
                            "columns"=>array(
                                'id',
                                array(
                                    'name'=>'cliente',
                                    'header'=>'Cliente',
                                    'type'=>'raw',
                                    'value'=>'$data->cliente->getNombreCompleto()'
                                    ),
                                'fecha_creacion',
                                array(
                                    'header'=>'',
                                    'type'=>'raw',
                                    'value'=>'$data->getButtonView()'
                                    )
                                )
                            )
                        ); ?>
                </div>
                <div class="box-footer">
                    <a href="<?php echo $this->createUrl('/ordenMudanza/?OrdenMudanza[estado]=1'); ?>" class="btn btn-default btn-block btn-flat"><li class="fa fa-arrow-circle-right"></li> Ver todos</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <li class="fa fa-map-marker"></li> <h3 class="box-title">Localizador de Mudanza</h3>
                </div>
                <div class="box-body" id="map-canvas" style="height:400px">
                </div>
            </div>
        </div>
    </div>
</section>

<?php 
$script = Yii::app()->clientScript;

$script->registerScriptFile("https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&language=es");
$marks = array();
foreach ($adestino as $key => $value) {
    $marks[] = array(
        'id'=>$value->id,
        'responsable'=>$value->responsable_destino,
        'direccion'=>$value->direccion_destino." ".$value->ciudadDestino->getCiudadCompleto(),        
        'location'=>$value->location
        );
}

$script->registerScript("maps","
    var marks = ".json_encode($marks).";
    var map;
    function initialize() {
        map = new google.maps.Map(document.getElementById('map-canvas'), {
            zoom: 5,
            center: {lat: 4.624335, lng: -74.063644}
        });
    
        for(i in marks){
            latlong = marks[i].location.split(',');
            var htmldata = '<div><b><a href=\"".$this->createUrl('ordenMudanza/view')."/'+marks[i].id+'\">ODM'+marks[i].id+'</a></b></div>'+
                      '<div><b>Responsable:</b> '+marks[i].responsable+'</div>'+
                      '<div><b>Entregar en:</b> '+marks[i].direccion+'</div>';
            
            var infowindow = new google.maps.InfoWindow({
                content: htmldata
            });
                      
            var mark = new google.maps.Marker({
                position: new google.maps.LatLng(latlong[0],latlong[1]),
                title:'ODM'+marks[i].id
            });

            mark.addListener('click',function(){
                infowindow.open(map,mark);
            });

            mark.setMap(map);
        }
    
    }

    google.maps.event.addDomListener(window, 'load', initialize);
"); ?>