<?php  
    class Database {
        // DB Params
        // private $host = 'localhost';
        // private $serverName = 'localhost\KAZDESKTOP';
        // private $databaseName = 'lbpsb_project';
        // private $username = 'kaz';
        // private $password = '';
        private $dsn = "sqlsrv:Driver=sqlsrv;sqlsrv:Server=localhost\KAZDESKTOP;Database=lbpsb_project;";
        private $conn;

        // DB Connect
        public function connect() {
            $this->conn = null;

            try {
                $this->conn = new PDO($dsn, 'kaz', '36912');
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                echo 'Connection Error: ' . $e->getMessage();
            }
        }



        // For Work
        // $conn = new PDO("sqlsrv:Server=SERVER_IP;Database=YOUR_DB", "USERNAME", "PASSWORD");
        // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // $stmt = $conn->prepare('SOME SQL STRING');
        // $stmt->bindParam(':firstname', $firstname);
        // $stmt->execute();
        // $result = $stmt->fetchAll();
        // foreach( $result as $obj ) {
        //     // CODE
        // }
    }