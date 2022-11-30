<?php

namespace Artesanias;

class Cliente{

    private $config;
    private $cn = null;

    public function __construct(){

        $this->config = parse_ini_file(__DIR__.'/../config.ini') ;

        $this->cn = new \PDO( $this->config['dns'], $this->config['usuario'],$this->config['clave'],array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        ));
        
    }

    public function registrar($_parametros){
        $sql = "INSERT INTO `clientes`(`nombre`, `documento`, `telefono`, `direccion`, `comentario`)
         VALUES (:nombre,:documento,:telefono,:direccion,:comentario)";

        $resultado = $this->cn->prepare($sql);

        $_array = array(
            ":nombre" => $_parametros['nombre'],
            ":documento" => $_parametros['documento'],
            ":telefono" => $_parametros['telefono'],
            ":direccion" => $_parametros['direccion'],
            ":comentario" => $_parametros['comentario']
        );

        if($resultado->execute($_array))
            return $this->cn->lastInsertId();

        return false;
    }
}