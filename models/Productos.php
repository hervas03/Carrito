<?php

require_once 'config/DB.php';
require_once 'models/Model.php';

class Productos implements Model
{

    private $id;
    private $nombre;
    private $descripcion;
    private $precios;
    private $stock;
    private $categoria;

    public function __construct()
    {
    }

    function getId()
    {
        return $this->id;
    }

    function getNombre()
    {
        return $this->nombre;
    }

    function getDescripcion()
    {
        return $this->descripcion;
    }

    function getPrecios()
    {
        return $this->precios;
    }

    function getStock()
    {
        return $this->stock;
    }

    function getCategoria()
    {
        return $this->categoria;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    function setPrecios($precios)
    {
        $this->precios = $precios;
    }

    function setStock($stock)
    {
        $this->stock = $stock;
    }

    function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }

    // Me va a devolver todos los elementos
    public function findAll()
    {
        $dataBase = DB::conectar();
        $findAll = $dataBase->query("SELECT * FROM `hervas.sl`.productos INNER JOIN `hervas.sl`.categorias where categoria_id = id_categorias;");
        return $findAll;
    }

    // Me devuelve el elemento filtrado por id
    public function findById()
    {
        $dataBase = DB::conectar();
        $findById = $dataBase->query("SELECT * FROM `hervas.sl`.productos where id_productos=$this->id")->fetch_object();
        // var_dump($findById);
        // exit();
        return $findById;
    }

    // Insertar en la base de datos
    public function save()
    {
        $dataBase = DB::conectar();
        $dataBase->query("INSERT INTO `hervas.sl`.`productos` (`nombre`, `descripcion`, `precio`, `stock`, `categoria_id`) VALUES ('$this->nombre','$this->descripcion','$this->precios','$this->stock','$this->categoria')");
    
    }

    // Actualizar en la base de datos filtrando por id
    public function update()
    {
        $dataBase = DB::conectar();
        $dataBase->query("UPDATE productos SET nombre='$this->nombre',descripcion='$this->descripcion', precio='$this->precios', stock='$this->stock', categoria_id='$this->categoria' WHERE id_productos=$this->id");
        
    }

    

        // Actualizar en la base de datos filtrando por id
        public function updateByCantidad(){
            $dataBase = DB::conectar();
            $update = $dataBase->query("UPDATE productos SET stock=stock-'$this->stock' WHERE id_productos=$this->id");
        }

    // Eliminar en la base de datos filtrando por id
    public function delete()
    {
            $dataBase = DB::conectar();
            $dataBase->query("DELETE FROM `hervas.sl`.`productos` WHERE (`id_productos` = '$this->id');");
    }

}