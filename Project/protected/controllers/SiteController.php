<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	*/
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}
	 
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
        
	public function actionDeepika()
	{
		$this->render('deepika');
	}

        
	public function actionStudent() 
	{
            $model = new StudentForm('new');
            if (isset($_POST['StudentForm'])) 
            {
                $model->attributes = $_POST['StudentForm'];
		if ($model->validate()) 
                {
                    Yii::app()->user->setFlash('success', 'Student info submitted successfully!');
                    // You can also save to DB or process data here
                    $model = new StudentForm; 
		}
            }
            $this->render('student', array('model' => $model));
	} 
        
        
            public function actionRegister()
            {
                $model = new User('register');
                if (isset($_POST['User'])) 
                {
                    $model->attributes = $_POST['User'];
                    if ($model->validate()) 
                    {
                        $conn = new mysqli("localhost", "root", "password", "login_project");
                        if ($conn->connect_error) 
                        {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        $name = $conn->real_escape_string($model->name);
                        $age = (int)$model->age;
                        $username = $conn->real_escape_string($model->username);
                        $password = password_hash($model->password, PASSWORD_DEFAULT);
                        $email = $conn->real_escape_string($model->email);
                        $location = $conn->real_escape_string($model->location);

                        $check = $conn->query("SELECT * FROM User WHERE username = '$username' OR email = '$email'");
                        if ($check->num_rows > 0) 
                        {
                            Yii::app()->user->setFlash('error', "<h5 style='color:red;'>Username or email already exists!</h5>");
                        } 
                        else 
                        {
                            $sql = "INSERT INTO User (name, age, username, password, email, location)
                                    VALUES ('$name', $age, '$username', '$password', '$email', '$location')";
                            if ($conn->query($sql) === TRUE) 
                            {
                                Yii::app()->user->setFlash('success', "<h5 style='color: green;'>Registration successful.</h5>");
                                $model = new Register();
                            } 
                            else 
                            {
                                Yii::app()->user->setFlash('error', "Database error: " . $conn->error);
                            }
                        }
                        $conn->close();
                    }
                }
                $this->render('register', array('model' => $model));
            }
            
            public function actionCheckEmail()
            {
                if (isset($_POST['email'])) 
                {
                    $email = $_POST['email'];
                    $exists = User::model()->exists('email = :email', array(':email' => $email));
                    echo $exists ? 'exists' : 'not_exists';
                }
            }




        
            public function actionLogin()
            {
                $model = new LoginForm('login');
                if (isset($_POST['LoginForm'])) 
                {
                    $model->attributes = $_POST['LoginForm'];
                    if ($model->validate() && $model->login()) 
                    {
                        Yii::app()->user->setFlash('success', 'Login Successful!');
                        $this->redirect(array('employee/index'));
                        return;
                    } 
                    else 
                    {
                        Yii::app()->user->setFlash('error', 'Login Failed! Invalid username or password.');
                    }
                }

                $this->render('login', ['model' => $model]);
            }



            
            public function actionForgot()
            {
                if (isset($_POST['email'])) 
                {
                    $email = $_POST['email'];
                    $user = User::model()->findByAttributes(['email' => $email]);

                    if ($user) 
                    {
                        $token = bin2hex(random_bytes(32));
                        $user->reset_token = $token;
                        $user->token_expire = date('Y-m-d H:i:s', strtotime('+1 hour'));

                        if ($user->save()) 
                        {
                            $resetLink = Yii::app()->createAbsoluteUrl('site/reset', [ 
                                'email' => $email,
                                'token' => $token,
                            ]);

                            Yii::import('application.extensions.phpmailer.PHPMailer');
                            Yii::import('application.extensions.phpmailer.SMTP');
                            Yii::import('application.extensions.phpmailer.Exception');

                            $mail = new PHPMailer(true);

                            try {
                                $mail->isSMTP();
                                $mail->Host = 'smtp.gmail.com';
                                $mail->SMTPAuth = true;
                                $mail->Username = 'deepikajoshva25@gmail.com';
                                $mail->Password = 'eeuu dvfo wibw afmr';
                                $mail->SMTPSecure = 'ssl';
                                $mail->Port = 465;

                                $mail->setFrom('deepika25@gmail.com', 'MyProject');
                                $mail->addAddress($email);
                                $mail->Subject = 'Password Reset Request';
                                $mail->isHTML(true);
                                $mail->Body = 'Hello , Click the link to reset your password: <br><a href="' . $resetLink . '">' . $resetLink . '</a><br><br><br><br><hr>
                                                <p>If you did not request this change, you can ignore this email.</p>';
                                                
                                $mail->send();

                                Yii::app()->user->setFlash('success', 'A reset link has been sent to your email address.');
                                $this->redirect(array('site/login')); 
                            } 
                            catch (Exception $e) 
                            {
                                Yii::app()->user->setFlash('error', 'Email could not be sent. Mailer Error: ' . $mail->ErrorInfo);
                            }
                        } 
                        else 
                        {
                            Yii::app()->user->setFlash('error', 'Could not save reset token. Try again later.');
                        }
                    } 
                    else 
                    {
                        Yii::app()->user->setFlash('error', 'No user found with that email address.');
                    }

                    $this->redirect(array('site/forgot'));
                }

                $this->render('forgot');
            }


            public function actionReset($email, $token)
            {
                $user = User::model()->findByAttributes([
                    'email' => $email,
                    'reset_token' => $token,
                ]);

                $message = ''; 
                if (!$user || !$user->reset_token ||strtotime($user->token_expire) < time()) 
                {
                    Yii::app()->user->setFlash('error', 'Invalid or expired token.');
                    $this->redirect(array('site/login')); 
                    return;
                }

                if (isset($_POST['password']) && isset($_POST['confirm_password'])) 
                {
                    if ($_POST['password'] === $_POST['confirm_password']) 
                    {
                        $user->password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                        $user->reset_token = null;
                        $user->token_expire = null;

                        if ($user->save()) 
                        {
                            Yii::app()->user->setFlash('success', 'Password changed successfully. You can now log in.');
                            $this->redirect(array('site/login'));
                        } 
                        else 
                        {
                            Yii::app()->user->setFlash('error', 'Error saving new password.');
                            var_dump($user->getErrors());
                        }
                    } 
                    else 
                    {
                        Yii::app()->user->setFlash('error', 'Passwords do not match.');
                    }
                }

                $this->render('reset', [
                    'email' => $email,
                    'token' => $token,
                    'message' => $message,
                ]);
                        
            }

        
              
}