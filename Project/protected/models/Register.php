<?php

class Register extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }


    public function rules()
    {
        return array(
            array('name, age, username, password, email, location', 'required'),
            array('email', 'unique','message' => 'Email "{value}" has already been taken.'),
            array('username', 'unique', 'message' => 'Username already exists.'),
//            array('password', 'length', 'min' => 6),
            array('password', 'validatePassword'),
        );
    }
    
    public function attributeLabels()
    {
        return array(
            'name' => 'Full Name',
            'age' => 'Age',
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'location' => 'Location',
        );
    }
    
    public function validatePassword($attribute, $params)
    {
        if (!preg_match('/[^a-zA-Z0-9]/', $this->$attribute)) 
        {
            $this->addError($attribute, 'Password must contain at least one special character.');
        }
    }
}


