<?php
    class Teacher {
        // DB info
        private $pdo;
        private $table = 'filter_teachers';

        //Teacher properties
        public $id;
        public $subject;
        public $grade;
        public $firstName;
        public $lastName;
        public $school;

        // Constructor
        public function __construct($db) {
            $this->pdo = $db;
        }

        // Get / Read Teachers
        public function readAll() {
            // Create Query
            // $query = "SELECT * FROM {$table}";
            $query = "SELECT * FROM filter_teachers";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            return $stmt;
        }
    }