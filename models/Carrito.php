<?php

require_once 'config/DB.php';
require_once 'models/Model.php';

class Carrito implements Model
{

    private $id;
    private $producto;
    private $precio;
    private $cantidad;
    private $stock;
    private $idusuario;
    private $idproducto;

    public function __construct()
    {
    }

    function getId()
    {
        return $this->id;
    }

    function getProducto()
    {
        return $this->producto;
    }

    function getPrecio()
    {
        return $this->precio;
    }

    function getCantidad()
    {
        return $this->cantidad;
    }

    function getStock()
    {
        return $this->stock;
    }

    function getidUsuario()
    {
        return $this->idusuario;
    }

    function getidProducto()
    {
        return $this->idproducto;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setProducto($producto)
    {
        $this->producto = $producto;
    }

    function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    }

    function setStock($stock)
    {
        $this->stock = $stock;
    }

    function setidUsuario($idusuario)
    {
        $this->idusuario = $idusuario;
    }

    function setidProducto($idproducto)
    {
        $this->idproducto = $idproducto;
    }

    // Me va a devolver todos los elementos
    public function findAll()
    {

    }

    // Me devuelve el elemento filtrado por id
    public function findById()
    {
        $dataBase = DB::conectar();
        $findById = $dataBase->query("SELECT id, producto, precio, cantidad, stock, idusuario FROM `hervas.sl`.carrito where idusuario='$this->idusuario'");
        return $findById;
    }

    // Insertar en la base de datos
    public function save()
    {
        $dataBase = DB::conectar();
        $dataBase->query("INSERT INTO carrito (producto, precio, cantidad, stock, idusuario, idproducto) VALUES ('$this->producto','$this->precio','$this->cantidad','$this->stock','$this->idusuario','$this->idproducto')");
        
    }

    // Actualizar en la base de datos filtrando por id
    public function update()
    {

    }

    // Eliminar en la base de datos filtrando por id
    public function delete()
    {

    }

    public function yaExiste(){



    }

}

?>