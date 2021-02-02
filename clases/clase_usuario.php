<?php

class User
{

    private $nombre;
    private $apellido;
    private $fechaNacimiento;
    private $pais;

    public function __construct($nombre, $apellido, $fechaNacimiento, $pais)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->pais = $pais;
    }

    public function getNombre()
    {
        return $this->nombre;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getApellido()
    {
        return $this->apellido;
    }
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    public function getNacimiento()
    {
        return $this->fechaNacimiento;
    }
    public function setNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    public function getPais()
    {
        return $this->pais;
    }
    public function setPais($pais)
    {
        $this->genero = $pais;
    }

    //CRUD
    public function guardarUsuario()
    {
        $contenidoArchivo = file_get_contents("../../data/usuarios.json");
        //convertir en arreglo asocitivo
        $usuarios = json_decode($contenidoArchivo, true);
        //usuarios[indice], el ultimo elemento + 1
        $usuarios[] = array(
            "nombre" => $this->nombre,
            "apellido" => $this->apellido,
            "fechaNacimiento" => $this->fechaNacimiento,
            "pais" => $this->pais
        );
        //sustituir todo -> 'w'
        $archivo = fopen("../../data/usuarios.json", "w");
        //fwrite: escribir el contenido
        fwrite($archivo, json_encode($usuarios));
        fclose($archivo);
    }

    public static function obtenerUsuarios()
    {
        $contenidoArchivo = file_get_contents("../../data/usuarios.json");
        echo $contenidoArchivo;
    }

    public static function obtenerUsuario($indice)
    {
        $contenidoArchivo = file_get_contents("../../data/usuarios.json");
        $usuarios = json_decode($contenidoArchivo, true);
        echo json_encode($usuarios[$indice]);
    }

    public function actualizarUsuario($indice)
    {
        $contenidoArchivo = file_get_contents("../../data/usuarios.json");
        $usuarios = json_decode($contenidoArchivo, true);
        // $usuario = $usuarios[$indice];
        $usuario = array(
            'nombre'=>$this->nombre,
            'apellido'=>$this->apellido,
            'fechaNacimiento'=>$this->fechaNacimiento,
            'pais'=>$this->pais
        );

        $usuarios[$indice] = $usuario;
        $archivo = fopen("../../data/usuarios.json",'w');
        fwrite($archivo,json_encode($usuarios));
        fclose($archivo);
    }

    public static function eliminarUsuario($indice)
    {
        $contenidoArchivo = file_get_contents("../../data/usuarios.json");
        $usuarios = json_decode($contenidoArchivo,true);
        array_splice($usuarios,$indice,1);

        $archivo = fopen("../../data/usuarios.json","w");
        fwrite($archivo,json_encode($usuarios));
        fclose($archivo);
    
}
}