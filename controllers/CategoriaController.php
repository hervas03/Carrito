<?php

class CategoriaController
{

    public static function categoriaAdmin()
    {
        if (isset($_SESSION['identity']) && isset($_SESSION['admin'])) {
            $categoria = new Categoria();
            echo $GLOBALS["twig"]->render(
                'adminPart/categoria/index.twig',
                [
                    'categoria' => $categoria->findAll(),
                    'identity' => $_SESSION['identity'],
                    'URL' => URL
                ]
            );
        } else {
            header('Location: ' . URL . 'auth/login');
        }
    }

    public static function createCategoria(){
        echo $GLOBALS['twig']->render('adminPart/categoria/create.twig',
            [
                'URL' => URL
            ]
        );
    }

    public static function create(){
        if(isset($_SESSION['identity'])){
            $categoria = new Categoria();
            $categoria->setId($_POST['id']);
            $categoria->setNombre($_POST['nombre']);
            $categoria->save();
            header('Location: '.URL.'categoria/categoriaAdmin');
        }else{
            header('Location: '.URL.'auth/login');
        }
    }

    public static function delete(){
        if(isset($_SESSION['identity'])){
            $categoria = new Categoria();
            $categoria->setId($_GET['id']);
            $categoria->delete();
            header('Location: '.URL.'categoria/categoriaAdmin');
        }else{
            header('Location: '.URL.'auth/login');
        }
    }

    public static function edit(){
        if(isset($_SESSION['identity']) && isset($_SESSION['admin'])){
            $categoria = new Categoria();
            $categoria->setId($_GET['id']);
            echo $GLOBALS["twig"]->render(
                'adminPart/categoria/edit.twig', 
                [
                    'categoria' => $categoria->findById(),
                    'identity' => $_SESSION['identity'],
                    'URL' => URL
                ]
            );
        }else{
            header('Location: '.URL.'auth/login');
        }
    }

    public static function update(){
        if(isset($_SESSION['identity'])){
            $categoria = new Categoria();
            $categoria->setId($_POST['id']);
            $categoria->setNombre($_POST['nombre']);
            $categoria->update();
            header('Location: '.URL.'categoria/categoriaAdmin');
        }else{
            header('Location: '.URL.'auth/login');
        }
    }


}