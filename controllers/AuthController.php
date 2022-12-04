<?php
require_once 'models/User.php';
class AuthController{

    public function login(){
        echo $GLOBALS['twig']->render('auth/login.twig',
            [
                'URL' => URL
            ]
        );
    }

    public function register(){
        echo $GLOBALS['twig']->render('auth/register.twig',
            [
                'URL' => URL
            ]
        );
    }

    //validar registro del usuario
    public function userLogin(){
        
        $user = new User();
        $user->setEmail($_POST['email']);
        $user->setPassword($_POST['password']);
        $user_ok = $user->login(); // objeto usuario si correcto o false si no correcto
         if($user_ok && is_object($user_ok)){
            //introduzco los datos de identity en user_ok
            $_SESSION['identity'] = $user_ok;
            if(isset($_SESSION['admin'])){
                //si el usuario que se registra es administrador, le redirigira a la pestaña de usuario
                header('Location: '.URL.'user/indexAdmin');
            }else{
                //en caso de no ser ADMIN, redirigira a la pestaña de usuario
               
                header('Location: '.URL.'user/indexUser');
            }
         }else{
            header('Location: '.URL.'auth/login');
         }
    }

    public function admin(){
        echo $GLOBALS['twig']->render('admin.twig',
            [
                'URL' => URL
            ]
        );
    }

    public function logout(){
        
        if(isset($_SESSION['identity'])){
            unset($_SESSION['identity']);
        } 
        
        if(isset($_SESSION['admin'])){
            unset($_SESSION['admin']);
        }

        header('Location: '.URL);        
    }

    public function userRegister(){
        $user = new User();
        $user->setNombre($_POST['nombre']);
        $user->setApellido($_POST['apellido']);
        $user->setEmail($_POST['email']);
        $user->setPassword(password_hash($_POST['password'], PASSWORD_BCRYPT, ['cont' => 4]));
        $user->save();
        $user->addRol();
        header('Location: '.URL.'auth/login');
    }

}

?>