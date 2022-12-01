<?php

require_once 'config/DB.php';
require_once 'models/Model.php';

class User implements Model
{

    private $id;
    private $nombre;
    private $apellido;
    private $email;
    private $rol;
    private $password;

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

    function getApellido()
    {
        return $this->apellido;
    }

    function getEmail()
    {
        return $this->email;
    }

    function getRol()
    {
        return $this->rol;
    }

    function getPassword()
    {
        return $this->password;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    function setEmail($email)
    {
        $this->email = $email;
    }

    function setRol($rol)
    {
        $this->rol = $rol;
    }

    function setPassword($password)
    {
        $this->password = $password;
    }

    //Metodos de la interface Model.php
    public function findAll()
    {
        $dataBase = DB::conectar();
        $findAll = $dataBase->query("SELECT * FROM `hervas.sl`.users INNER JOIN `hervas.sl`.user_has_rol where id = id_user;");
        return $findAll;
    }

    public function addRol()
    {
        $dataBase = DB::conectar();
        $addRol = $dataBase->query("INSERT INTO `hervas.sl`.`user_has_rol` (`rol`) VALUES ('2');");
        return $addRol;
    }

    //Metodo buscar por id
    public function findById()
    {
        $dataBase = DB::conectar();
        $findById = $dataBase->query("SELECT * FROM `hervas.sl`.users INNER JOIN `hervas.sl`.user_has_rol where user_has_rol.id_user =$this->id and users.id=$this->id")->fetch_object();
        return $findById;
    }

    //Metodo de salvar usuario
    public function save()
    {
        $dataBase = DB::conectar();
        // if ($this->password != null) {
            $dataBase->query("INSERT INTO users (nombre, apellido, email, password) VALUES ('$this->nombre','$this->apellido', '$this->email', '$this->password')");
        // }
    }

    public function saveRol()
    {
        $dataBase = DB::conectar();
        // if ($this->password != null) {
            $dataBase->query("INSERT INTO user_has_rol (rol) VALUES ('$this->rol')");
        // }
    }

    //Metodo de actualizar usuario
    public function update()
    {
        $dataBase = DB::conectar();
        if (!empty($_POST['password'])) {
            $dataBase->query("UPDATE users SET nombre='$this->nombre',apellido='$this->apellido', email='$this->email', password='$this->password' WHERE id=$this->id");
        } else {
            $dataBase->query("UPDATE users SET nombre='$this->nombre',apellido='$this->apellido', email='$this->email' WHERE id=$this->id");
        }
    }

    public function updateRol(){
        $dataBase = DB::conectar();
        $updateRol = $dataBase->query("UPDATE user_has_rol SET rol=$this->rol WHERE id_user=$this->id");
    }

    //Metodo para eliminar un usuario
    public function delete()
    {
        $dataBase = DB::conectar();
        $dataBase->query("DELETE FROM users WHERE id=$this->id");
    }

    public function deleteRol()
    {
        $dataBase = DB::conectar();
        $dataBase->query("DELETE FROM user_has_rol WHERE id_user=$this->id");
    }

    public function login()
    {
        $dataBase = DB::conectar();
        $sql = "SELECT * FROM users WHERE email = '$this->email'";
        
        $user = $dataBase->query($sql);
        
        
        if($user && $user->num_rows == 1){
            
            $user = $user->fetch_object();
            $verify = password_verify($this->password, $user->password);
            // var_dump($verify);
            // exit();
            if($verify){
                if($this->isAdmin($user->id)){
                    $_SESSION['admin'] = true;
                }
                return $user;
            }else{
                return false;
            }
        }
    }

    public static function isAdmin($id){
        $dataBase = DB::conectar();
        $tipo = $dataBase->query("SELECT rol FROM user_has_rol WHERE id_user=$id")->fetch_object();
        if($tipo->rol == 1){
            return true;
        }else{
            return false;
        }
    }
}
