<?php

/**
 * This is the model class for table "asset".
 *
 * The followings are the available columns in table 'asset':
 * @property integer $id
 * @property string $serial_number1
 * @property string $serial_number2
 * @property string $asset_type
 * @property integer $asset_type_id
 *
 * The followings are the available model relations:
 * @property AssetUsage[] $assetUsages
 * @property AssetType $assetType
 */
class Asset extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'asset';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('asset_type , asset_type_id ,serial_number1, serial_number2', 'required'),
                        array('status', 'length', 'max'=>14),
                        array('asset_type','unique'),
                        array('serial_number1, serial_number2','unique'),
			array('asset_type_id', 'numerical', 'integerOnly'=>true),
			array('serial_number1, serial_number2, asset_type', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, serial_number1, serial_number2,status, asset_type, asset_type_id', 'safe', 'on'=>'search'),
                        array('serial_number1', 'validateSerials1'),
                        array('serial_number1', 'validateSerials2'),
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
			'assetUsages' => array(self::HAS_MANY, 'AssetUsage', 'asset_id'),
			'assetType' => array(self::BELONGS_TO, 'AssetType', 'asset_type_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'serial_number1' => 'Serial Number1',
			'serial_number2' => 'Serial Number2',
			'asset_type' => 'Assets',
			'asset_type_id' => 'Asset Type',
                        'status' => 'Status',
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
		$criteria->compare('serial_number1',$this->serial_number1,true);
		$criteria->compare('serial_number2',$this->serial_number2,true);
		$criteria->compare('asset_type',$this->asset_type,true);
		$criteria->compare('asset_type_id',$this->asset_type_id);
                $criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        
        public function validateSerials1($attribute, $params)
        {
            $exists1 = Asset::model()->exists(
                '(serial_number1 = :sn1 OR serial_number2 = :sn1) AND id != :id',
                array(':sn1' => $this->serial_number1, ':id' => (int)$this->id)
            );

            if ($exists1) 
            {
                $this->addError('serial_number1', 'This Serial Number1 already exists as either Serial Number 1 or 2.');
            }
        }
        
        
        public function validateSerials2($attribute, $params)
        {
            $exists2 = Asset::model()->exists(
                '(serial_number1 = :sn2 OR serial_number2 = :sn2) AND id != :id',
                array(':sn2' => $this->serial_number2, ':id' => (int)$this->id)
            );

            if ($exists2) 
            {
                $this->addError('serial_number2', 'This Serial Number2 already exists as either Serial Number 1 or 2.');
            }
        }


        
        
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Asset the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
