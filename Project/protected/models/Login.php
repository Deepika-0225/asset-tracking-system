<?php

class Login extends CFormModel
{
    public $username;
    public $password;
    private $_identity;

    public function rules()
    {
        return array(
            array('username, password', 'required'),
            array('password', 'authenticate'),
            array('rememberMe', 'boolean'),
            array('password', 'match', 'pattern'=>'/^(?=.*[\W_]).{8}$/', 'message'=>'Password must be 8–20 characters and include at least one special character.'),
        );
    }

    public function authenticate($attribute,$params)
    {
	if(!$this->hasErrors())
	{
            $this->_identity=new UserIdentity($this->username,$this->password);
            if(!$this->_identity->authenticate())
                $this->addError('password','Incorrect username or password.');
	}
    }

    public function login()
    {
        $user = User::model()->findByAttributes(['username' => $this->username]);
        if ($user && password_verify($this->password, $user->password)) 
        {
            //Yii::app()->user->setState('userId', $user->id);
            Yii::app()->user->setState('username', $user->username);
            return true;
        }
        return false;
    }
}

