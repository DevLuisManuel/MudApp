<?php

/**
 * This is the model class for table "appsession".
 *
 * The followings are the available columns in table 'appsession':
 * @property integer $id
 * @property integer $usuario_id
 * @property string $key
 * @property string $created
 * @property string $expire
 *
 * The followings are the available model relations:
 * @property Usuario $usuario
 */
class Appsession extends CActiveRecord
{
	public $uid;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'appsession';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('usuario_id, key, created, expire', 'required','on'=>'insert,update'),
			array('usuario_id', 'numerical', 'integerOnly'=>true),
			array('key', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, usuario_id, key, created, expire', 'safe', 'on'=>'search'),
			array('key,uid','required','on'=>'validacion'),
			array('key,uid','safe','on'=>'validacion'),
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
			'usuario' => array(self::BELONGS_TO, 'Usuario', 'usuario_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'usuario_id' => 'Usuario',
			'key' => 'Key',
			'created' => 'Created',
			'expire' => 'Expire',
			'uid'=>'uid'
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
		$criteria->compare('usuario_id',$this->usuario_id);
		$criteria->compare('key',$this->key,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('expire',$this->expire,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Appsession the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
