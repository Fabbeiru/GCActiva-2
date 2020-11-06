<?php

include_once 'data_access.class.php';

class User {
    
    public static function session_start(){
        if(session_status () === PHP_SESSION_NONE){
            session_start();
        }
    }
    
    public static function getLoggedUser(){ //Devuelve un array con los datos del cuenta o false
        self::session_start();
        if(!isset($_SESSION['user'])) return false;
        return $_SESSION['user'];
    }
    
    public static function login($usuario,$pass){ //Devuelve verdadero o falso según
        self::session_start();
        if(DB::user_exists($usuario, $pass, $res)){
            $_SESSION['user']=$res[0]; //Almacena datos del usuario en la sesión
            return true;
        }
        return false;
    }
    
    public static function logout(){
        self::session_start();
        unset($_SESSION['user']);
    }

    public static function registerUser ($usuario, $pass, $name, $usetype, $email, $poblacion, $direccion, $telefono){
        //Devuelve verdadero o falso según
        $SQL = "INSERT INTO usuarios (cuenta, clave, nombre, tipo, email, poblacion, direccion, telefono) 
            VALUES ('$usuario','$pass', '$name', '$usetype', '$email', '$poblacion', '$direccion', '$telefono')";
        $res=DB::execute_sql($SQL);
    }
}
