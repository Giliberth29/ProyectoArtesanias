<?php

namespace Artesanias;

class productoCarrito{

    private $config;
    private $cn = null;

    public function __construct(){

        $this->config = parse_ini_file(__DIR__.'/../config.ini') ;

        $this->cn = new \PDO( $this->config['dns'], $this->config['usuario'],$this->config['clave'],array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        ));
        
    }

    public function registrar($_parametros){
        $sql = "INSERT INTO `productos`(`titulo`, `descripcion`, `imagen`, `precio`, `categoria_id`, `fecha`) VALUES (:titulo, :descripcion,:imagen,:precio, :categoria_id,:fecha)";

        $resultado = $this->cn->prepare($sql);

        $array = array(
           ":titulo" => $_parametros ['titulo'],
           ":descripcion" => $_parametros ['descripcion'],
           ":imagen" => $_parametros ['imagen'],
           ":precio" => $_parametros ['precio'], 
           ":categoria_id" => $_parametros ['categoria_id'],
           ":fecha" => $_parametros ['fecha']
        );
        
        if($resultado -> execute($array))
            return true;
        
        return false;

    }

    public function actualizar($_parametros){
        
        $sql = "UPDATE `productos` SET `titulo`=:titulo,`descripcion`=:descripcion,`imagen`=:imagen,`precio`=:precio,`categoria_id`=:categoria_id,`fecha`=:fecha WHERE `id` = :id";

        $resultado = $this->cn->prepare($sql);

        $array = array(
           ":titulo" => $_parametros ['titulo'],
           ":descripcion" => $_parametros ['descripcion'],
           ":imagen" => $_parametros ['imagen'],
           ":precio" => $_parametros ['precio'], 
           ":categoria_id" => $_parametros ['categoria_id'],
           ":fecha" => $_parametros ['fecha'],
           ":id" => $_parametros['id']
        );
        
        if($resultado -> execute($array))
            return true;
        
        return false;

    }

    public function  eliminar($id){

        $sql = "DELETE FROM `productos` WHERE `id` = :id";
        $resultado = $this->cn->prepare($sql);

        $array = array(
           ":id" => $id
        );
        
        if($resultado -> execute($array))
            return true;
        
        return false;
        
    }

    public function  mostrar(){
        
        $sql = "SELECT productos.id, titulo, descripcion,imagen,nombre,precio,fecha,estado FROM productos 
        
        INNER JOIN categorias 
        ON productos.categoria_id = categorias.id ORDER BY productos.id DESC
        ";
        $resultado = $this->cn->prepare($sql);

        if($resultado -> execute())
            return $resultado-> fetchAll();
        
        return false;

    }

    public function  mostrarPorId($id){
        
        $sql = "SELECT * FROM `productos` WHERE `id` = :id";
        $resultado = $this->cn->prepare($sql);

        $array = array(
            ":id" => $id
         );

        if($resultado -> execute($array))
            return $resultado-> fetch();
        
        return false;
    }

}

?>