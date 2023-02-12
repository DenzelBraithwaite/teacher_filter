<?php  
    class Database {
        // DB Params
        // private $host = 'localhost';
        // private $serverName = 'localhost\KAZDESKTOP';
        // private $databaseName = 'lbpsb_project';
        // private $username = 'test';
        // private $password = 'test';
        private $dsn = "sqlsrv:Driver=sqlsrv;sqlsrv:Server=localhost\KAZDESKTOP;Database=lbpsb_project;";
        private $pdo;

        // DB Connect
        public function connect() {
            $this->pdo = null;

            try {
                $this->pdo = new PDO($this->dsn, 'test', 'test');
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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