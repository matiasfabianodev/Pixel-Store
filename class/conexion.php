<?php 
    class Conexion 
        {
            private $host = "localhost";
            private $user = "root";
            private $pass = "";
            private $db = "pixelstore";

            public function conectar() 
                {
                    try 
                        {
                            $dsn = "mysql:host=$this->host;dbname=$this->db";
                            $pdo = new PDO($dsn, $this->user, $this->pass);
                            return $pdo;
                        } 
                    catch (Exception $e) 
                    {
                        $camino = (basename(dirname($_SERVER['SCRIPT_NAME'])) === 'views') ? '' : 'views/';
                        header("Location: " . $camino . "error.php");
                        exit();
                    }
                }
        }
?>