<?php $this->controller_name = "Inicio"; ?>
<?php $this->action_name = "Lista de ordenes de mudanza"; ?>
<?php $this->layout = '/layouts/main'; ?>

<section class="content">
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Mudanzas pendientes por entregar</h3>
        </div>
        <div class="box-body">
        <?php
            $this->widget("ext.yiibooster.widgets.TbGridView",array(
                "dataProvider"=>$model->search(),                
                "columns"=>array(
                    array(
                        'name'=>'id',
                        'htmlOptions'=>array(
                            'width'=>'7%'
                            )
                        ),
                    'fecha_creacion',                    
                    array(
                        'name'=>'ciudad_origen',
                        'header'=>'Origen',
                        'type'=>'raw',
                        'value'=>'$data->getInformacionDireccion()',
                        'htmlOptions'=>array('width'=>'22%')
                        ),
                    array(
                        'name'=>'ciudad_destino',
                        'header'=>'Destino',
                        'type'=>'raw',
                        'value'=>'$data->getInformacionDireccion(false)',
                        'htmlOptions'=>array('width'=>'22%')
                        ),                   
                    array(
                        'header'=>'Acción',
                        'type'=>'raw',
                        'value'=>'$data->getButtons()'
                        )
                    )
                )
            );
        ?>

        </div>
    </div>

    <div id="map-canvas" style="width:100%; height:300px; background:#999"></div>

</section>

<?php 
$script = Yii::app()->clientScript;

$script->registerScriptFile("https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&language=es");
$marks = array();

foreach ($model->search()->getData() as $key => $value) {
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