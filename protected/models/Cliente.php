<?php

/**
 * This is the model class for table "cliente".
 *
 * The followings are the available columns in table 'cliente':
 * @property integer $id
 * @property string $primer_nombre
 * @property string $segundo_nombre
 * @property string $primer_apellido
 * @property string $segundo_apellido
 * @property integer $tipo_documento_id
 * @property string $documento
 * @property integer $ciudad_id
 * @property string $direccion
 * @property string $telefono
 * @property integer $genero
 * @property string $fecha_nacimiento
 * @property string $email
 * @property string $password
 * @property integer $estado
 *
 * The followings are the available model relations:
 * @property TipoDocumento $tipoDocumento
 * @property OrdenMudanza[] $ordenMudanzas
 */
class Cliente extends CActiveRecord
{

	public $departamento_id;
	public $repassword;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cliente';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('primer_nombre, primer_apellido, segundo_apellido, tipo_documento_id, documento, ciudad_id, direccion, telefono, genero, fecha_nacimiento, email, password, estado, departamento_id', 'required','message'=>'{attribute} no puede ser nulo.'),
			array('tipo_documento_id, ciudad_id, genero, estado', 'numerical', 'integerOnly'=>true),
			array('primer_nombre, segundo_nombre, primer_apellido, segundo_apellido', 'length', 'max'=>15),
			array('documento', 'length', 'max'=>20),
			array('email','unique','className'=>'Cliente','attributeName'=>'email','message'=>'Email ya esta en uso'),
			array('documento','unique','className'=>'Cliente','attributeName'=>'documento','message'=>'El documento que ingreso ya esta en uso'),
			array('direccion', 'length', 'max'=>45),
			array('password','length','min'=>6,'max'=>45),
			array('email','email','message'=>'{attribute} no es email valido.'),
			array('fecha_nacimiento','date','message'=>'{attribute} invalida.','format'=>'yyyy-MM-dd'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, tipo_documento_id, documento, ciudad_id, direccion, telefono, genero, fecha_nacimiento, email, password, estado', 'safe', 'on'=>'search'),
			array('tipo_documento_id,documento','required','on'=>'buscarcliente'),
			array('tipo_documento_id,documento','safe','on'=>'buscarcliente'),
			array('departamento_id,repassword','safe'),
			array('repassword','compare','compareAttribute'=>'password','message'=>'Las contraseñas no coinciden.'),
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
			'tipoDocumento' => array(self::BELONGS_TO, 'TipoDocumento', 'tipo_documento_id'),
			'ordenMudanzas' => array(self::HAS_MANY, 'OrdenMudanza', 'cliente_id'),
			'ciudad' => array(self::BELONGS_TO, 'Ciudad', 'ciudad_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'primer_nombre' => 'Primer Nombre',
			'segundo_nombre' => 'Segundo Nombre',
			'primer_apellido' => 'Primer Apellido',
			'segundo_apellido' => 'Segundo Apellido',
			'tipo_documento_id' => 'Tipo Documento',
			'documento' => 'Documento de Identidad',
			'departamento_id'=>'Departamento',
			'ciudad_id' => 'Ciudad',
			'direccion' => 'Dirección',
			'telefono' => 'Teléfono',
			'genero' => 'Género',
			'fecha_nacimiento' => 'Fecha Nacimiento',
			'email' => 'Email',
			'password' => 'Contraseña',
			'repassword'=>'Verificacion de contraseña',
			'estado' => 'Estado',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('primer_nombre',$this->primer_nombre,true);
		$criteria->compare('segundo_nombre',$this->segundo_nombre,true);
		$criteria->compare('primer_apellido',$this->primer_apellido,true);
		$criteria->compare('segundo_apellido',$this->segundo_apellido,true);
		$criteria->compare('tipo_documento_id',$this->tipo_documento_id);
		$criteria->compare('documento',$this->documento,true);
		$criteria->compare('ciudad_id',$this->ciudad_id);
		$criteria->compare('direccion',$this->direccion,true);
		$criteria->compare('telefono',$this->telefono,true);
		$criteria->compare('genero',$this->genero);
		$criteria->compare('fecha_nacimiento',$this->fecha_nacimiento,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('estado',$this->estado);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'id DESC'
				)
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Cliente the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function getNombreCompleto(){
		$nombres = trim($this->primer_nombre." ".$this->segundo_nombre);
		return trim($nombres." ".$this->primer_apellido." ".$this->segundo_apellido);
	}

	public function getTipoDocumento($abrev=false){
		return $abrev?$this->tipoDocumento->abreviatura:$this->tipoDocumento->nombre;
	}

	public function getInformacion($photo_size = 60){
		return Yii::app()->controller->renderPartial('/cliente/_informacion_cliente',array('model'=>$this,'s'=>$photo_size));
	}

	public function getAnos(){
		$hoy = time();
		$cumple = strtotime($this->fecha_nacimiento);
		return floor(($hoy-$cumple)/60/60/24/365);
	}

	public function getEstadoRaw(){
		switch ($this->estado) {
			case 0:
				$estado = '<span class="label bg-red">Inactivo</span>';
			case 1:
				$estado = '<span class="label bg-green">Activo</span>';
				break;
			default:
				$estado = '<span class="label bg-gray">Indefinido</span>';
				break;
		}
		return $estado;
	}

	public function getUbicacion(){
		return $this->ciudad->nombre.", ".$this->ciudad->departamento->nombre;
	}

	public function getInformacionContacto(){
		return '<div><span class="fa fa-phone"></span> '.$this->telefono.'</div>'.
		       '<div><span class="fa fa-map-marker"></span> '.$this->direccion.'</div>';
	}

	public function getButtons(){
		return CHtml::link('<span class="fa fa-search"></span>',array('/cliente/view/'.$this->id),array('title'=>'Ver')).' '.
			   CHtml::link('<span class="fa fa-edit"></span>',array('/cliente/update/'.$this->id),array('title'=>'Editar')).' '.
			   CHtml::link('<span class="fa fa-truck"></span>','#',array('title'=>'Crear mudanza','submit'=>array('/ordenMudanza/create/')));			   
	}
}
