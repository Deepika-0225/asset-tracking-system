<?php
class Admin extends CActiveRecord 
{
    public static function model($className=__CLASS__) 
    {
        return parent::model($className);
    }
    public function tableName() 
    {
        return 'admin';
    }
    public function rules() 
    {
        return [
            ['username, password', 'required']
        ];
    }
}


