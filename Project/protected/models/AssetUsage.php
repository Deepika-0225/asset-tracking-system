<?php

/**
 * This is the model class for table "AssetUsage".
 *
 * The followings are the available columns in table 'AssetUsage':
 * @property integer $id
 * @property integer $asset_id
 * @property integer $employee_id
 * @property string $start_date
 * @property string $end_date
 * @property integer $is_taken_out_of_office
 * @property string $status
 * @property integer $location_id
 *
 * The followings are the available model relations:
 * @property Asset $asset
 * @property Employee $employee
 * @property LocationMaster $location
 */
class AssetUsage extends CActiveRecord
{
        public $employee_name;
        public $asset_name;
        public $asset_type_id;

        public function tableName()
        {
            return 'AssetUsage';
        }
            
        public function rules()
        {
            return array(
                array('asset_type_id, asset_id, employee_id, location_id, start_date', 'required', 'on' => 'create ,update'),
                array('asset_id, employee_id, is_taken_out_of_office, location_id', 'numerical', 'integerOnly'=>true),
                array('start_date, end_date', 'safe'),
                array('start_date', 'validateStartDate', 'on' => 'create, update'),
                array('end_date', 'required', 'on' => 'enddate'),
                array('end_date', 'validateEndDate', 'on' => 'enddate'),
                array('end_date', 'safe', 'on' => 'enddate'),
                array('id, asset_id, employee_id, asset_type_id,start_date, end_date, is_taken_out_of_office, status, location_id', 'safe', 'on' => 'search'),
                array('asset_id', 'validateAssetAvailability', 'on' => 'create'),
            );
        }


        public function relations()
            {
                    // NOTE: you may need to adjust the relation name and the related
                    // class name for the relations automatically generated below.
                    return array(
                            'asset' => array(self::BELONGS_TO, 'Asset', 'asset_id'),
                            'employee' => array(self::BELONGS_TO, 'Employee', 'employee_id'),
                            'location' => array(self::BELONGS_TO, 'LocationMaster', 'location_id'),
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
                        'asset_type_id' => 'Asset Type',
			'asset_id' => 'Assets',
			'employee_id' => 'Employee',
			'start_date' => 'Start Date',
			'end_date' => 'End Date',
			'is_taken_out_of_office' => 'Is Taken Out Of Office',
			//'status' => 'Status',
			'location_id' => 'Location',
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

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
                $criteria->compare('asset_type_id' ,$this->asset_type_id);
		$criteria->compare('asset_id',$this->asset_id);
		$criteria->compare('employee_id',$this->employee_id);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('end_date',$this->end_date,true);
		$criteria->compare('is_taken_out_of_office',$this->is_taken_out_of_office);
		//$criteria->compare('status',$this->status,true);
		$criteria->compare('location_id',$this->location_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

        protected function beforeSave()     // Converts start and end dates from dd-mm-yyyy to yyyy-mm-dd (DB format).
        {
            if (parent::beforeSave()) 
            {
                $this->start_date = $this->convertToDbDate($this->start_date);
                if (!empty($this->end_date)) 
                {
                    $this->end_date = $this->convertToDbDate($this->end_date);
                } 
                else 
                {
                    $this->end_date = null;
                }
                return true;
            }
            return false;
        }

        public function convertToDbDate($date)      // Convert dd-mm-yyyy to yyyy-mm-dd format
        {
            $timestamp = CDateTimeParser::parse($date, 'dd-MM-yyyy');
            if ($timestamp === false) 
            {
                return null;
            }
            return date('Y-m-d', $timestamp);
        }
        
        public function afterFind()     // Converts DB date format to dd-mm-yyyy for display in the form.
	{
		$this->start_date = $this->convertToDisplayDate($this->start_date);
		$this->end_date = $this->convertToDisplayDate($this->end_date);
		parent::afterFind();
	}
        
        private function convertToDisplayDate($date)
	{
		if (empty($date) || $date == '0000-00-00') return '';
		$timestamp = strtotime($date);
		return $timestamp ? date('d-m-Y', $timestamp) : '';
	}

               
        public function validateStartDate($attribute, $params)    //  Start Date must be greater than current Date
        {
            $inputDate = DateTime::createFromFormat('d-m-Y', $this->start_date);
            $today = new DateTime();    // Y-m-d

            if (!$inputDate) 
            {
                $this->addError($attribute, 'Invalid start date format.');
                return;
            }

            if ($inputDate && ($this->isNewRecord || $this->start_date != $this->findByPk($this->id)->start_date)) 
            {
                if ($inputDate < $today)    // New record (creating) or Existing record and start_date has changed
                {
                    $this->addError($attribute, 'Start date must be greater than today.');
                }
            }
            
        }

        
        public function validateEndDate($attribute, $params)    //  End Date must be after Start Date
        {
            if (empty($this->end_date)) return;

            $startDate = DateTime::createFromFormat('d-m-Y', $this->start_date);
            if (!$startDate) 
            {
                $startDate = DateTime::createFromFormat('Y-m-d', $this->start_date);
            }

            $endDate = DateTime::createFromFormat('d-m-Y', $this->end_date);
            if (!$endDate) 
            {
                $endDate = DateTime::createFromFormat('Y-m-d', $this->end_date);
            }

            if (!$startDate || !$endDate) 
            {
                $this->addError($attribute, 'Invalid date format.');
                return;
            }

            if ($endDate <= $startDate) 
            {
                $this->addError($attribute, 'End date must be greater than start date.');
            }
        }
        
        
//        public function validateAssetAvailability($attribute, $params) //   check if asset is already in use
//        {
//            $existing = AssetUsage::model()->find(array(
//                'condition' => 'asset_id = :asset_id AND (end_date IS NULL OR end_date > CURDATE())',
//                'params' => array(':asset_id' => $this->asset_id),
//            ));
//
//            if ($existing) 
//            {
//                $employeeName = $existing->employee ? $existing->employee->name : 'Unknown';
//                $this->addError('asset_id', "This asset is already assigned to {$employeeName}.");
//            }
//        }
        
        public function validateAssetAvailability($attribute, $params)
        {
            if (empty($this->start_date) || empty($this->asset_id)) 
            {
                return;  
            }
//            print_r($this->asset_type_id);exit;
            $errors=array();
            $assetUsages = AssetUsage::model()->with('asset')->findAll('asset.asset_type_id=:v1 and asset_id=:v2',array(':v1'=>$this->asset_type_id,':v2'=>$this->asset_id));
              foreach ($assetUsages as $assetUsage)
              {
                  if($assetUsage->start_date > $this->start_date || $assetUsage->start_date < $this->end_date)
                  {
                      $this->addError($attribute, 'This asset is already in use during the selected period.');
                  }
              }
        }


        
        public static function model($className=__CLASS__)
        {
                return parent::model($className);
        }
}
