<?php

class ProductosController
{

    public static function productosAdmin()
    {
        if (isset($_SESSION['identity']) && isset($_SESSION['admin'])) {
            $productos = new Productos();
            echo $GLOBALS["twig"]->render(
                'adminPart/productos/index.twig',
                [
                    'productos' => $productos->findAll(),
                    'identity' => $_SESSION['identity'],
                    'URL' => URL
                ]
            );
        } else {
            header('Location: ' . URL . 'auth/login');
        }
    }

    public static function createProducto(){
        echo $GLOBALS['twig']->render('adminPart/productos/create.twig',
            [
                'URL' => URL
            ]
        );
    }

    public static function create(){
        if(isset($_SESSION['identity'])){
            $producto = new Productos();
            $producto->setId($_POST['id']);
            $producto->setNombre($_POST['nombre']);
            $producto->setDescripcion($_POST['descripcion']);
            $producto->setPrecios($_POST['precio']);
            $producto->setStock($_POST['stock']);
            $producto->setCategoria($_POST['categoria']);
            $producto->save();
            header('Location: '.URL.'productos/productosAdmin');
        }else{
            header('Location: '.URL.'auth/login');
        }
    }

    public static function edit(){
        if(isset($_SESSION['identity']) && isset($_SESSION['admin'])){
            $producto = new Productos();
            $producto->setId($_GET['id']);
            echo $GLOBALS["twig"]->render(
                'adminPart/productos/edit.twig', 
                [
                    'producto' => $producto->findById(),
                    'identity' => $_SESSION['identity'],
                    'URL' => URL
                ]
            );
        }else{
            header('Location: '.URL.'controller=auth/login');
        }
    }

    public static function update(){
        if(isset($_SESSION['identity'])){
            $producto = new Productos();
            $producto->setId($_POST['id']);
            $producto->setNombre($_POST['nombre']);
            $producto->setDescripcion($_POST['descripcion']);
            $producto->setPrecios($_POST['precio']);
            $producto->setStock($_POST['stock']);
            $producto->setCategoria($_POST['categoria']);
            $producto->update();
            header('Location: '.URL.'productos/productosAdmin');
        }else{
            header('Location: '.URL.'auth/login');
        }
    }

    public static function delete(){
        if(isset($_SESSION['identity'])){
            $producto = new Productos();
            $producto->setId($_GET['id']);
            $producto->delete();
            header('Location: '.URL.'productos/productosAdmin');
        }else{
            header('Location: '.URL.'auth/login');
        }
    }

}