<?php

namespace Artesanias;

class Usuario{

    private $config;
    private $cn = null;

    public function __construct(){

        $this->config = parse_ini_file(__DIR__.'/../config.ini') ;

        $this->cn = new \PDO( $this->config['dns'], $this->config['usuario'],$this->config['clave'],array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        ));
        
    }

    public function loginUsuario($usuario,$contrasena){
        
        $sql = "SELECT usuario FROM `inicio_admin` 
        WHERE usuario = :usuario AND contrasena = :contrasena";
        $resultado = $this->cn->prepare($sql);

        $array = array(
            ":usuario" => $usuario,
            ":contrasena" => $contrasena
         );

        if($resultado -> execute($array))
            return $resultado-> fetch();
        
        return false;
    }
}