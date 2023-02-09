<?php

// $conn = new PDO("sqlsrv:Server=SERVER_IP;Database=YOUR_DB", "USERNAME", "PASSWORD");
// $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// $stmt = $conn->prepare('SOME SQL STRING');
// $stmt->bindParam(':firstname', $firstname);
// $stmt->execute();
// $result = $stmt->fetchAll();
// foreach( $result as $obj ) {
//     // CODE
// }

// // Web Server Name: Web-Test



$uri = $_SERVER['REQUEST_URI'];
echo gettype($uri);

// switch ($uri) {
//     case '/api/users':
//         echo json_encode(array(
//             'users' => array(
//                 array(
//                     'name' => 'John Doe',
//                     'age' => 30
//                 ),
//                 array(
//                     'name' => 'Jane Doe',
//                     'age' => 25
//                 )
//             )
//         ));
//         break;
//     default:
//         http_response_code(404);
//         echo json_encode(array(
//             'error' => 'Not Found'
//         ));
//         break;
// }