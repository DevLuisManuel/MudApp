<?php

/**
 * This is the model class for table "orden_mudanza_item".
 *
 * The followings are the available columns in table 'orden_mudanza_item':
 * @property integer $id
 * @property integer $orden_mudanza_id
 * @property integer $categoria_id
 * @property string $titulo
 * @property string $descripcion
 * @property string $codigo
 * @property integer $estado
 *
 * The followings are the available model relations:
 * @property Categoria $categoria
 * @property OrdenMudanza $ordenMudanza
 */
class OrdenMudanzaItem extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'orden_mudanza_item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('orden_mudanza_id, categoria_id, titulo, descripcion, codigo, estado', 'required','on'=>'insert,update'),
			array('orden_mudanza_id, categoria_id, estado', 'numerical', 'integerOnly'=>true),
			array('titulo', 'length', 'max'=>45),
			array('codigo', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, orden_mudanza_id, categoria_id, titulo, descripcion, codigo, estado', 'safe', 'on'=>'search'),
			array('orden_mudanza_id,codigo','required','on'=>'entrega'),
			array('orden_mudanza_id,codigo','safe','on'=>'entrega')
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
			'categoria' => array(self::BELONGS_TO, 'Categoria', 'categoria_id'),
			'ordenMudanza' => array(self::BELONGS_TO, 'OrdenMudanza', 'orden_mudanza_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'orden_mudanza_id' => 'Orden Mudanza',
			'categoria_id' => 'Categoria',
			'titulo' => 'Titulo',
			'descripcion' => 'Descripcion',
			'codigo' => 'Codigo',
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
		$criteria->compare('orden_mudanza_id',$this->orden_mudanza_id);
		$criteria->compare('categoria_id',$this->categoria_id);
		$criteria->compare('titulo',$this->titulo,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('codigo',$this->codigo,true);
		$criteria->compare('estado',$this->estado);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OrdenMudanzaItem the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}	

	public function getInformacionRaw(){
		return '<div><string>'.CHtml::encode($this->titulo).'</strong></div>'.
			   '<div>'.CHtml::encode($this->descripcion).'</div>'.
			   '<div>Cat: '.$this->categoria->nombre.'</div>'.
			   '<div><span class="label '.$this->getEstadosClass().'">'.$this->getEstados().'</span></div>';
	}

	public function getEstados(){
		switch ($this->estado) {
			case 1: return 'Agregado';
				break;
			case 2: return 'Confirmado';
				break;
			case 3: return 'Descargado';
				break;
			case 4: return 'Entregado';
				break;
			case 5: return 'No entregado';	
			default:
				return 'Indefinido';
				break;
		}
	}

	public function getEstadosClass(){
		switch ($this->estado) {
			case 1: return 'label-default';
				break;
			case 2: return 'label-primary';
				break;
			case 3: return 'label-warning';
				break;
			case 4: return 'label-success';
				break;	
			case 5: return 'label-danger';
				break;	
			default:
				return 'label-default';
				break;
		}
	}

	public function getEstadoRaw(){
		return '<span class="label '.$this->getEstadosClass().'">'.$this->getEstados().'</span>';
	}

	public function getProductoRaw(){
		return '<div class="row">'.
			   '	<div class="col-md-2 col-sm-2 cols-xs-2">'.
			   '		'.CHtml::image(Yii::app()->theme->baseUrl.'/img/'.$this->categoria->getIcon(),'icon',array('width'=>'60px')).		
			   '	</div>'.
			   '	<div class="col-md-10 col-sm-10 cols-xs-10">'.
			   '		<div><b>'.CHtml::encode($this->titulo).'</b></div>'.
			   '		<div>'.CHtml::encode($this->descripcion).'</div>'.
			   '		<div><small>'.CHtml::encode($this->codigo).'</small></div>'.
			   '	</div>'.
			   '</div>';
	}
	
}
