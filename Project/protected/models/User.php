<?php

class User extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'User';
    }

    public function rules()
    {
        return array(
            array('name, age, username, password, email, location', 'required','on'=>'register'),
            array('email', 'unique','message' => 'Email "{value}" has already been taken.'),
            array('username', 'unique', 'message' => 'Username already exists.','on'=>'register'),
            array('password', 'length', 'min' => 6),
            array('password', 'validatePassword','on'=>'login'),
            array('name, age, username, password, email, location,reset_token,token_expire' , 'safe'),
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
            'reset_token'=>'ResetToken',
            'token_expire'=>'TokenExpire',
            
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
