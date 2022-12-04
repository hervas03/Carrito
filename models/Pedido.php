<?php

    class Pedido implements Model{
        
        private $id;
        private $usuario;
        private $fecha;
        
        /**
         * Class constructor.
         */
        public function __construct() {
            
        }

        function getId() {
            return $this->id;
        }
    
        function getUsuario() {
            return $this->usuario;
        }
    
        function getFecha() {
            return $this->fecha;
        }
    
        function setId($id) {
            $this->id = $id;
        }
    
        function setUsuario($usuario) {
            $this->usuario = $usuario;
        }
    
        function setFecha($fecha) {
            $this->fecha = $fecha;
        }

        // Me va a devolver todos los elementos
        public function findAll(){

        $dataBase = DB::conectar();
        $findAll = $dataBase->query("SELECT * FROM `hervas.sl`.pedidos inner join `hervas.sl`.users where users.id =$this->id and pedidos.usuario_id=$this->id;");
        return $findAll;

        }

        public function findById(){
            $dataBase = DB::conectar();
            $findById = $dataBase->query("SELECT * FROM `hervas.sl`.pedidos_has_productos where pedido_id=$this->id")->fetch_object();
            // var_dump($findById);
            // exit();
            return $findById;
        }

        // Me devuelve el elemento filtrado por usuario
        public function findByUser(){

        }

        // Insertar en la base de datos
        public function save(){
            $db = DB::conectar();
            $save = $db->query("INSERT INTO pedidos (usuario_id, fecha) VALUES ('$this->usuario', CURDATE())");
            return $db->insert_id;
        }

        // Actualizar en la base de datos filtrando por id
        public function update(){
        
        }

        // Eliminar en la base de datos filtrando por id
        public function delete(){

        }
    }
?>