<?php
class StudentForm extends CFormModel 
{
    public $name;
    public $email;
    public $age;
    public $rememberMe;

    public function rules() 
    {
        return array(
            array('name, email, age', 'required','on'=>'new'),
            array('email', 'email'),
            array('age', 'numerical', 'integerOnly' => true, 'min' => 1),
            array('rememberMe','boolean'),
        );
    }
    

    // Custom labels
    public function attributeLabels() 
    {
        return array(
            'name' => 'Student Name : ',
            'email' => 'Email Address : ',
            'age' => 'Age : ',
            'rememberMe'=>'Remember me next time',
        );
    }
}
?>
