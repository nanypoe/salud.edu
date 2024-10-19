<?php
class Sessiones
{
    public static function acceso($rol)
    {
        if(Sessiones::getClave('autenticado'))
        {
            if( Sessiones::getNivel(Sessiones::getClave('rol')) >= Sessiones::getNivel($rol)){
                return true;
            } 
           else
            header("Location:".BASE_URL.'error/error/505');
        }
        else
        header("Location:".BASE_URL.'error/error/504');
    }

    public static function getVista($rol)
    {
        if(Sessiones::getClave('autenticado'))
        {
            if( Sessiones::getNivel(Sessiones::getClave('rol')) >= Sessiones::getNivel($rol)){
                return true;
            } 
            else
            return false;
        }
        else
        return false;
    }

    public static function accesoVista($rol){
        if(Sessiones::getClave('rol')==$rol)
        return true;
        else
        return false;
    }

    public static function getNivel($nivel)
    {
        $rol['admin']=3;
        $rol['docente']=2;
        $rol['estudiante']=1;
        if(isset($rol[$nivel]))  
            return $rol[$nivel]; 
        else
            return 0;     
    }

    public static function setClave($clave,$valor)
    {
        $_SESSION[$clave]=$valor;
    }

    public static function iniciar()
    {
        session_start();
        // Establecer tiempo de vida de la sesión (30 minutos)
        $timeout = 1800; // 30 segundos

        // Comprobar si ya existe un tiempo de inicio
        if (isset($_SESSION['tiempo_inicio'])) {
            // Calcular el tiempo transcurrido
            $tiempo_transcurrido = time() - $_SESSION['tiempo_inicio'];

            // Si ha pasado el tiempo de expiración, destruir la sesión
            if ($tiempo_transcurrido > $timeout) {
                self::salir(); // Destruir la sesión
                header("Location:".BASE_URL.'login'); // Redirigir a la página de error
                exit();
            }
        }

        // Actualizar el tiempo de inicio
        $_SESSION['tiempo_inicio'] = time();
    }

    public static function getClave($clave)
    {
        if(isset($_SESSION[$clave]))
            return $_SESSION[$clave];
        else
            return false;
    }

    public static function salir()
    {
        // Destruir todas las variables de sesión
        $_SESSION = array();

        // Si se desea, también se puede eliminar la cookie de sesión
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // Finalmente, destruir la sesión
        session_destroy();
    }

    public static function iniciarSesion($usuario)
    {
        // Iniciar la sesión
        self::iniciar();

        // Establecer la clave de autenticación y el rol
        self::setClave('autenticado', true);
        self::setClave('rol', $usuario['rol']);

        // Regenerar el ID de sesión
        session_regenerate_id(true); // true para eliminar el ID anterior

        // Establecer el tiempo de inicio
        $_SESSION['tiempo_inicio'] = time();
    }

}