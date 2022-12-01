<?php

require_once 'config/DB.php';
require_once 'models/Model.php';

class Categoria implements Model
{

    private $id;
    private $nombre;

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

    function setId($id)
    {
        $this->id = $id;
    }

    function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function findAll()
    {
        $dataBase = DB::conectar();
        $findAll = $dataBase->query("SELECT * FROM categorias;");
        return $findAll;
    }

    // Me devuelve el elemento filtrado por id
    public function findById(){
        $dataBase = DB::conectar();
        $findById = $dataBase->query("SELECT * FROM `hervas.sl`.categorias where id_categorias=$this->id")->fetch_object();
        return $findById;
    }

    // Insertar en la base de datos
    public function save()
    {
        $dataBase = DB::conectar();
        // if ($this->password != null) {
            $dataBase->query("INSERT INTO categorias (nombre_categoria) VALUES ('$this->nombre')");
        // }
    }

    // Actualizar en la base de datos filtrando por id
    public function update(){
        $dataBase = DB::conectar();
        $dataBase->query("UPDATE categorias SET nombre_categoria='$this->nombre' WHERE id_categorias=$this->id");
        // var_dump("UPDATE categorias SET nombre='$this->nombre' WHERE id_categorias=$this->id");
        // exit();
    }

    // Eliminar en la base de datos filtrando por id
    public function delete()
    {
        $dataBase = DB::conectar();
        $dataBase->query("DELETE FROM categorias WHERE id_categorias=$this->id");
    }


}