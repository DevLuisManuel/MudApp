<?php

/**
 * This is the model class for table "orden_mudanza".
 *
 * The followings are the available columns in table 'orden_mudanza':
 * @property integer $id
 * @property string $fecha_creacion
 * @property integer $creador
 * @property integer $ciudad_origen
 * @property string $direccion_origen
 * @property string $responsable_origen
 * @property integer $ciudad_destino
 * @property string $direccion_destino
 * @property string $responsable_destino
 * @property integer $asegurado
 * @property integer $embalaje
 * @property integer $operario
 * @property integer $estado
 * @property string $fecha_recojida
 * @property integer $cliente_id
 * @property string $location
 *
 * The followings are the available model relations:
 * @property Ciudad $ciudadOrigen
 * @property Ciudad $ciudadDestino
 * @property Cliente $cliente
 * @property Usuario $creador0
 * @property Usuario $operario0
 * @property OrdenMudanzaItem[] $ordenMudanzaItems
 */
class OrdenMudanza extends CActiveRecord
{
	public $departamento_origen;
	public $departamento_destino;
	public $minDate;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'orden_mudanza';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fecha_creacion, creador, ciudad_origen, direccion_origen, responsable_origen, ciudad_destino, direccion_destino, responsable_destino, estado, cliente_id, departamento_destino, departamento_origen', 'required','message'=>'{attribute} no puede ser nulo.','on'=>'insert,update'),
			array('creador, ciudad_origen, ciudad_destino, asegurado, embalaje, operario, estado, cliente_id', 'numerical', 'integerOnly'=>true),
			array('fecha_recojida, location', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fecha_creacion, creador, ciudad_origen, direccion_origen, responsable_origen, ciudad_destino, direccion_destino, responsable_destino, asegurado, embalaje, operario, estado, fecha_recojida, cliente_id, location', 'safe', 'on'=>'search'),
			array('departamento_destino, departamento_origen,location','safe'),
			array('operario,fecha_recojida,estado','required','on'=>'asignar'),
			array('operario,fecha_recojida,estado','safe','on'=>'asignar')
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'ciudadOrigen' => array(self::BELONGS_TO, 'Ciudad', 'ciudad_origen'),
			'ciudadDestino' => array(self::BELONGS_TO, 'Ciudad', 'ciudad_destino'),
			'cliente' => array(self::BELONGS_TO, 'Cliente', 'cliente_id'),
			'usuario_creador' => array(self::BELONGS_TO, 'Usuario', 'creador'),
			'operario0' => array(self::BELONGS_TO, 'Usuario', 'operario'),
			'ordenMudanzaItems' => array(self::HAS_MANY, 'OrdenMudanzaItem', 'orden_mudanza_id'),
			// Cantidad por categoria
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fecha_creacion' => 'Fecha Creacion',
			'creador' => 'Creador',
			'ciudad_origen' => 'Ciudad Origen',
			'direccion_origen' => 'Direccion Origen',
			'responsable_origen' => 'Responsable Origen',
			'ciudad_destino' => 'Ciudad Destino',
			'direccion_destino' => 'Direccion Destino',
			'responsable_destino' => 'Responsable Destino',
			'asegurado' => 'Asegurado',
			'embalaje' => 'Embalaje',
			'operario' => 'Operario',
			'estado' => 'Estado',
			'fecha_recojida' => 'Fecha Recogida',
			'cliente_id' => 'Cliente',
			'location' => 'Location',
			'departamento_origen'=>'Departamento Origen',
			'departamento_destino'=>'Departamento Destino'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('t.id',$this->id);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);
		$criteria->compare('creador',$this->creador);
		$criteria->compare('ciudad_origen',$this->ciudad_origen);
		$criteria->compare('direccion_origen',$this->direccion_origen,true);
		$criteria->compare('responsable_origen',$this->responsable_origen,true);
		$criteria->compare('ciudad_destino',$this->ciudad_destino);
		$criteria->compare('direccion_destino',$this->direccion_destino,true);
		$criteria->compare('responsable_destino',$this->responsable_destino,true);		
		if($this->asegurado==1)
			$criteria->compare('asegurado',$this->asegurado);
		if($this->embalaje==1)
			$criteria->compare('embalaje',$this->embalaje);
		$criteria->compare('operario',$this->operario);
		$criteria->compare('t.estado',$this->estado);
		$criteria->compare('fecha_recojida',$this->fecha_recojida,true);
		$criteria->compare('t.cliente_id',$this->cliente_id,false);		
		$criteria->compare('cliente.documento',$this->cliente_id,false,'OR');
		$criteria->compare('location',$this->location,true);
		$criteria->with = array('cliente');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'t.id DESC'
				)
		));
	}

	public function reporteMudanza(){
		$criteria = new CDbCriteria;		
		$criteria->addCondition('EXTRACT(YEAR_MONTH FROM fecha_creacion) = "'.$this->fecha_creacion.'"');
		$criteria->addCondition('estado IN (5,6,7)');
		$criteria->params = array(":fecha",$this->fecha_creacion);

		return new CActiveDataProvider($this,array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pagesize'=>20
				)
			)
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OrdenMudanza the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getButtons(){
		return CHtml::link('<span class="fa fa-search"></span>',Yii::app()->controller->createUrl('ordenMudanza/view/'.$this->id)).' '.
			   ($this->estado==1?CHtml::link('<span class="fa fa-refresh"></span>',Yii::app()->controller->createUrl('ordenMudanza/update/'.$this->id)):'');
			   
	}

	public function getInformacionDireccion($origen=true){
		if($origen){
			$responsable = $this->responsable_origen;
			$direccion = $this->direccion_origen;
			$ciudad = $this->ciudadOrigen;
		}
		else{
			$responsable = $this->responsable_destino;
			$direccion = $this->direccion_destino;
			$ciudad = $this->ciudadDestino;
		}

		return Yii::app()->controller->renderPartial('/ordenMudanza/_informacion_direccion',array('responsable'=>$responsable,'direccion'=>$direccion,'ciudad'=>$ciudad));
	}

	public function getEstadosRaw(){
		switch ($this->estado) {
			case 1:
				return '<span class="label label-info">Solicitado</span>';
				break;
			case 2:
				return '<span class="label label-info">En Proceso</span>';
				break;
			case 3:
				return '<span class="label label-primary">A origen</span>';
				break;
			case 4:
				return '<span class="label label-success">A destino</span>';
				break;
			case 5:
				return '<span class="label label-default">Finalizado</span>';
				break;
			case 6:
				return '<span class="label label-danger">Cancelado</span>';
				break;
			case 7:
				return '<span class="label label-warning">Inconsistencia</span>';
				break;
			default:
				return '<span class="label label-defaut">Indefinido</span>';
				break;
		}
	}

	public function getEstadosList(){
		return array(
			'1'=>'Solicitado',
			'2'=>'En Proceso',
			'3'=>'A origen',
			'4'=>'A destino',
			'5'=>'Finalizado',
			'6'=>'Cancelado',
			'7'=>'Inconsistencia'
			);
	}
	public function getEstados(){
		switch ($this->estado) {
			case 1:
				return 'Solicitado';
				break;
			case 2:
				return 'En Proceso';
				break;
			case 3:
				return 'A origen';
				break;
			case 4:
				return 'A destino';
				break;
			case 5:
				return 'Finalizado';
				break;
			case 6:
				return 'Cancelado';
				break;
			case 7:
				return 'Inconsistencia';
				break;
			default:
				return 'Indefinido';
				break;
		}
	}

	public function getButtonView(){
		return CHtml::link('<span class="fa fa-search"></span>',array('/ordenMudanza/view/'.$this->id),array('class'=>'btn btn-primary btn-mini'));
	}

	public function getMinDate(){
		$criteria = new CDbCriteria;
		$criteria->select = "min(EXTRACT(YEAR_MONTH from fecha_creacion)) AS minDate";
		$result = self::model()->find($criteria);
		return $result->minDate;
	}

	public function getLisDateMinMax(){
		$min = $this->getMinDate();
		$meses = explode(",","Enero,Febrero,Marzo,Abril,Mayo,Junio,Julio,Agosto,Septiembre,Octubre,Noviembre,Diciembre");
		$timeold = !$min?time():strtotime($this->getMinDate()."01");
		$timeact = time();		
		$data = array();
		while($timeold<=$timeact){
			$data[date('Ym',$timeold)] = $meses[date("n",$timeold)-1].date('/Y',$timeold);
			$timeold = strtotime("+1 month",$timeold);
		}
		return $data;
	}

	public function getIndicadores(){
		$finalizadas = $this->reporteMudanza()->getCriteria()->addCondition('estado = 5');
		$canceladas = $this->reporteMudanza()->getCriteria()->addCondition('estado = 6');
		$inconsistencia = $this->reporteMudanza()->getCriteria()->addCondition('estado = 7');
		$data = array(
					array(
						'label'=>'Finalizadas',
						'value'=>self::model()->count($finalizadas)
						),
					array(
						'label'=>'Canceladas',
						'value'=>self::model()->count($canceladas)
						),
					array(
						'label'=>'Inconsistencia',
						'value'=>self::model()->count($inconsistencia)
						),
			);
		return json_encode($data);
	}

	public function countItemcategoria($id=null){
		$criteria = new CDbCriteria;
		$criteria->compare('orden_mudanza_id',$this->id);
		
		if($id!==null){
			$criteria->compare('categoria_id',$id);
		}

		return OrdenMudanzaItem::model()->count($criteria);
	}

	public function getItemsCategoria($id=null){
		$criteria = new CDbCriteria();
		$criteria->compare('orden_mudanza_id',$this->id);
		$criteria->order = 'id ASC';
		
		if($id!==null){
			$criteria->compare('categoria_id',$id);
		}

		return new CActiveDataProvider('OrdenMudanzaItem',array(
					'criteria'=>$criteria,
					'sort'=>false,
					'pagination'=>false
				)
			);
	}

	public function reporteMaxInconsistencia(){
		$criteria = new CDbCriteria;
		$criteria->addCondition('EXTRACT(YEAR_MONTH FROM odm.fecha_creacion) = "'.$this->fecha_creacion.'"');
		$criteria->compare('t.estado',1);
		$criteria->compare('t.rol',2);
		$criteria->compare('odm.estado',7);
		$criteria->with = array('ordenMudanzas1'=>array('alias'=>'odm','joinType'=>'INNER JOIN'));
		$criteria->select = array('*','COUNT(odm.id) AS n_inconsistencia');		
		$criteria->together = true;
		$criteria->group = 't.id';
		$criteria->order = 'n_inconsistencia DESC';

		return new CActiveDataProvider('Usuario',array(
				'criteria'=>$criteria,
				'sort'=>false,
				'pagination'=>false
				)
			);
	}
}
