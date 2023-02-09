<?php  
$serverName = "KAZDESKTOP"; 
$databaseName = "lbpsb_project"; 

// This wasn't working, although it's valid for my ssms server
// $username = "kaz";   
// $password = "";  

// If user and password are not specified in the $connectionInfo array,
// The connection will be attempted using Windows Authentication.
$connectionInfo = [
    // "username"=>$username,
    // "password"=>$password,
    "database"=>$databaseName
];

/* Connect using SQL Server Authentication. */  
$connection = sqlsrv_connect( $serverName, $connectionInfo);  

if ($connection) {
    // echo "Connection established 😁.<br>";
} else {
    echo "Connection could not be established.😥<br>";
    die( print_r( sqlsrv_errors(), true));
}

/* Set up Transact-SQL query example. */  
// $tsql = "UPDATE Sales.SalesOrderDetail   
//          SET OrderQty = ?   
//          WHERE SalesOrderDetailID = ?";  
/* Assign parameter values. */  
// $param1 = 5;  
// $param2 = 10;  
// $params = array(&$param1, &$param2);  

// ❗ Update after to use params and be more secure ❗
// $exampleQuery = "SELECT * FROM filter_teachers";

function fetchTeachers ($query) {
    global $connection;

    /* Check if query can be prepared. */  
    if (!$statement = sqlsrv_prepare($connection, $query)) {
        echo "Statement/query invalid and cannot be executed. 😥<br>";  
        die(print_r(sqlsrv_errors(), true));  
    };
    /* Execute the prepared statement. */  
    if (sqlsrv_execute($statement)) {  
        $results = []; // Might not need to initialize
        $queryResource = sqlsrv_query($connection, $query);
        // $queryResource = sqlsrv_execute($statement); // Should also work
        $counter = 0;
        while ($row = sqlsrv_fetch_array($queryResource, SQLSRV_FETCH_ASSOC)) {
            $results["index $counter"] = [
                'first_name'=>$row['first_name'],
                'last_name'=>$row['last_name'],
                'school'=>$row['school'],
                'subject'=>$row['subject'],
                'grade'=>$row['grade']
            ];
            $counter ++;
        };
    } else {  
        echo "Query could not be executed. 😥<br>";  
        die(print_r(sqlsrv_errors(), true));  
    }  
    
    return $results;
}

function fetchSchools () {
    global $connection;
    $query = "SELECT name FROM schools;";

    /* Check if query can be prepared. */  
    if (!$statement = sqlsrv_prepare($connection, $query)) {
        echo "Statement/query invalid and cannot be executed. 😥<br>";  
        die(print_r(sqlsrv_errors(), true));  
    };
    /* Execute the prepared statement. */  
    if (sqlsrv_execute($statement)) {  
        $queryResource = sqlsrv_query($connection, $query);
        $schoolList = [];
        $notSchools = array('human resources', 'information systems');
        while ($row = sqlsrv_fetch_array($queryResource, SQLSRV_FETCH_ASSOC)) {
            $school_name = $row['name'];
            if (!in_array($school_name, $notSchools)){
                array_push($schoolList, $school_name);
            };
        };
    } else {  
        echo "Query could not be executed. 😥<br>";  
        die(print_r(sqlsrv_errors(), true));  
    }  
    
    return $schoolList;
}
/* Free the statement and connection resources. */  
// sqlsrv_free_stmt($statement);  
// sqlsrv_close($connection);  
?>