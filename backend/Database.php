<?php  
    class Database {
        // DB Params
        // private $host = 'localhost';
        private $serverName = 'KAZDESKTOP';
        private $databaseName = 'lbpsb_project';
        private $username = 'kaz';
        private $password = '';
        private $conn;

        // DB Connect
        public function connect() {
            $this->conn = null;

            try {
                $this->conn = new PDO(
                    "sqlsrv:Server={$this->serverName};
                    Database={$this->databaseName};"
                );
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // $stmt = $this->conn->prepare('SELECT * FROM filter_teachers');
                // // $stmt->bindParam(':first_name', $firstName);
                // $stmt->execute();
                // $result = $stmt->fetchAll();
                // foreach($result as $obj) {
                //     echo gettype($obj);
                // }
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