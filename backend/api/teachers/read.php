<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET');
    header('Content-Type: application/json');
    header('Accept: application/json');

    include_once '../../Database.php';
    include_once '../../models/Teacher.php';

    // Instantiate Database object & connect to it
    $database = new Database();
    $pdo = $database->connect();

    // Instantiate Teacher object
    $teacher = new Teacher($pdo);

    // Teacher query
    $result = $teacher->read();

    // Get row count
    $num = $result->rowCount();

    // Check if any teachers
    if ($num > 0) {
        $teachers_arr = [];
        $teachers_arr['data'] = [];

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $teacher_item = [
                'subject' => $subject,
                'grade' => $grade,
                'firstName' => $first_name,
                'lastName' => $last_name,
                'school' => $school
            ];

            // Push to 'data'
            array_push($teachers_arr['data'], $teacher_item);
        }

        // Turn to JSON
        echo json_encode($teachers_arr);
    } else {
        echo json_encode(['message' => 'No Teachers Found']);
    }