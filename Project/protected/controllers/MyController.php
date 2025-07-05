<?php


class MyController extends Controller 
{
    
            public function actionLogin()
            {
                $message = "";
                if ($_SERVER["REQUEST_METHOD"] == "POST") 
                {
                    $username = Yii::app()->request->getPost('username');
                    $password = Yii::app()->request->getPost('password');
                    $user = User::model()->findByAttributes(['username' => $username]);

                    if ($user && password_verify($password, $user->password)) 
                    {
                        $message = "Login Successful!";
                    } 
                    else 
                    {
                        $message = "Login Failed! Wrong username or password.";
                    }
                }

                $this->render('login', array('message' => $message));
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
                            $resetLink = Yii::app()->createAbsoluteUrl('my/reset', [ 
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

                                $mail->setFrom('deepika2001@gmail.com', 'MyProject');
                                $mail->addAddress($email);
                                $mail->Subject = 'Password Reset Request';
                                $mail->isHTML(true);
                                $mail->Body = 'Hello , Click the link to reset your password: <br><a href="' . $resetLink . '">' . $resetLink . '</a><br><br><br><br><hr>
                                                <p>If you did not request this change, you can ignore this email.</p>';
                                                
                                $mail->send();

                                Yii::app()->user->setFlash('success', 'A reset link has been sent to your email address.');
                                $this->redirect(array('my/login')); 
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

                    $this->redirect(array('my/forgot'));
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
                    $this->redirect(array('my/login')); 
                    return;
                }

                if (isset($_POST['password']) && isset($_POST['confirm_password'])) 
                {
                    if ($_POST['password'] === $_POST['confirm_password']) 
                    {
                        $user->password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                        var_dump($user->getErrors());
                        $user->reset_token = null;
                        $user->token_expire = null;

                        if ($user->save()) 
                        {
                            Yii::app()->user->setFlash('success', 'Password changed successfully. You can now log in.');
                            $this->redirect(array('my/login'));
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

