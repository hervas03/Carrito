<?php

class UserController
{


    //pagina que se carga cuando el administrador, inicia, recojiendo asi los datos de los usuarios, donde se mostraran por pantalla
    public static function indexAdmin()
    {
        //valido que sea admin
        if (isset($_SESSION['identity']) && isset($_SESSION['admin'])) {
            $user = new User();
            echo $GLOBALS["twig"]->render(
                'adminPart/user/index.twig',
                [
                    //que me encuentre todos los users en la variable users
                    'users' => $user->findAll(),
                    'identity' => $_SESSION['identity'],
                    'URL' => URL
                ]
            );
        } else {
            header('Location: ' . URL . 'auth/login');
        }
    }

    public function indexUser(){
        $productos = new Productos();
        echo $GLOBALS['twig']->render('userPart/index.twig',
            [
                'productos' => $productos->findAll(),
                'identity' => $_SESSION['identity'],
                'URL' => URL
            ]
        );
    }

    public function indexPublic(){
        $productos = new Productos();
        echo $GLOBALS['twig']->render('home/productos.twig',
            [
                'productos' => $productos->findAll(),
                'URL' => URL
            ]
        );
    }

    //eliminar desde el administrador unn usuario
    public static function delete(){
        if(isset($_SESSION['identity'])){
            $user = new User();
            $user->setId($_GET['id']);
            $user->delete();
            $user->deleteRol();
            header('Location: '.URL.'user/indexAdmin');
        }else{
            header('Location: '.URL.'auth/login');
        }
    }

    public static function createUser(){
        echo $GLOBALS['twig']->render('adminPart/user/create.twig',
            [
                'URL' => URL
            ]
        );
    }

    public static function edit(){
        if(isset($_SESSION['identity']) && isset($_SESSION['admin'])){
            $user = new User();
            $user->setId($_GET['id']);
            echo $GLOBALS["twig"]->render(
                'adminPart/user/edit.twig', 
                [
                    'user' => $user->findById(),
                    'identity' => $_SESSION['identity'],
                    'URL' => URL
                ]
            );
        }else{
            header('Location: '.URL.'controller=auth/login');
        }
    }

    public static function create(){
        if(isset($_SESSION['identity'])){
            $user = new User();
            $user->setId($_POST['id']);
            $user->setNombre($_POST['nombre']);
            $user->setApellido($_POST['apellido']);
            $user->setEmail($_POST['email']);
            $user->setRol($_POST['rol']);
            if(isset($_POST['password'])){
                $user->setPassword(password_hash($_POST['password'], PASSWORD_BCRYPT, ['cont' => 4]));
            }
            $user->saveRol();
            $user->save();
            header('Location: '.URL.'user/indexAdmin');
        }else{
            header('Location: '.URL.'auth/login');
        }
    }

    public static function update(){
        if(isset($_SESSION['identity'])){
            $user = new User();
            $user->setId($_POST['id']);
            $user->setNombre($_POST['nombre']);
            $user->setApellido($_POST['apellido']);
            $user->setEmail($_POST['email']);
            $user->setRol($_POST['rol']);
            if(isset($_POST['password'])){
                $user->setPassword(password_hash($_POST['password'], PASSWORD_BCRYPT, ['cont' => 4]));
            }
            $user->updateRol();
            $user->update();
            header('Location: '.URL.'user/indexAdmin');
        }else{
            header('Location: '.URL.'auth/login');
        }
    }
}
