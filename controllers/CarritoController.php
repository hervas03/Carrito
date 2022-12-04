<?php

class CarritoController{

    // public static function carritoIndex(){
    //     if(isset($_SESSION['identity']) && !isset($_SESSION['admin'])){
    //         $carrito = new Carrito();
    //         $carrito->setidUsuario($_SESSION['identity']->id);
    //         echo $GLOBALS['twig']->render('carrito/index.twig', 
    //             [
    //                 'carrito' => $carrito->findById(),
    //                 'identity' => $_SESSION['identity'],
    //                 'URL' => URL
    //             ]
    //         );
    //     }
    // }

    public static function carritoIndex()
    {
        if(isset($_SESSION['identity']) && !isset($_SESSION['admin']) && isset($_SESSION['carrito'][$_SESSION['identity']->id])){
            echo $GLOBALS['twig']->render('carrito/index.twig', 
                [
                    'carrito' => $_SESSION['carrito'][$_SESSION['identity']->id],
                    'identity' => $_SESSION['identity'],
                    'URL' => URL
                ]
            );
        } else {
            echo $GLOBALS['twig']->render('carrito/empy.twig', 
                [
                    'identity' => $_SESSION['identity'],
                    'URL' => URL
                ]
            );
        }
    }

    public static function delete(){
        if(isset($_SESSION['identity']) && !isset($_SESSION['admin'])){
            if(isset( $_SESSION['carrito'][$_SESSION['identity']->id])){
                unset($_SESSION['carrito'][$_SESSION['identity']->id]);
            }
        }
        header('Location: '.URL.'carrito/carritoIndex');
    }


    public static function agregar(){
        if(isset($_SESSION['identity']) && !isset($_SESSION['admin'])){
            /**
             * Primero recojo el id del producto que selecciono
             */
            $id = $_GET['id'];
            $producto = new ProductoS();
            $producto->setId($id);
            $nombre = $producto->findById()->nombre;
            $precio = $producto->findById()->precio;
            $cantidad = 1;

            $_SESSION['carrito'][$_SESSION['identity']->id][] = array(
                "producto_id" => $id,
                "nombre" => $nombre,
                "precio" => $precio,
                "cantidad" => $cantidad
            );
            
            header('Location: '.URL.'carrito/carritoIndex');
        } else {
            header('Location: '.URL.'auth/login');
        }
    }
}


?>