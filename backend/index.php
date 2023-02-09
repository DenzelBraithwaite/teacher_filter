<?php
include "db.php";

// Make one long query for the form, querying from one table at first.
// Then concatenate each form input optionally using if statements.
// If the user input or chose something, then concatenate it to the query.
// Return results in the same predefined table always.
// first name, last name, subject, school and grade columns.


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="style.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,400;0,500;0,700;0,900;1,400&display=swap" rel="stylesheet">
  <title>Teacher Viewer | Filter School Staff and Student</title>
</head>
<body>
  <div class="container-lg">

    
    <!-- Search Hero Form -->
    <h2 class="section-title">Teacher Search</h2>
    <div class="banner-group">
      <img class="banner-img" src="img/classroom.png" alt="elementary students in class">
      <form id="teacher-form" action="index.php" method="POST">
        <div class="form-group">
          <label for="first-name">First Name</label>
          <?php
            if (!empty($_POST['first-name'])) {
              $firstName = $_POST['first-name'];
              echo "<input value='$firstName' id='first-name' name='first-name' type='text'>";
            } else {
              echo "<input id='first-name' name='first-name' type='text' placeholder='Ex: Albus'>";
            };
          ?> 
        </div>

        <div class="form-group">
          <label for="last-name">Last Name</label>
          <?php
            if (!empty($_POST['last-name'])) {
              $lastName = $_POST['last-name'];
              echo "<input value='$lastName' id='last-name' name='last-name' type='text'>";
            } else {
              echo "<input id='last-name' name='last-name' type='text' placeholder='Ex: Dumbledore'>";
            };
          ?>   
        </div>
        
        <div class="form-group">
          <label for="school">School</label>
          <select name="school" id="school">
            <option value=""></option>
            <?php
              $schools = fetchSchools();
              echo count($schools);
              foreach ($schools as $school) {
                echo "<option value='$school'>$school</option>";
              };
            ?>
          </select>
        </div>

        <div class="form-group">
          <label for="subject">Subject</label>
          <select name="subject" id="subject">
            <option value=""></option>
            <option value="math">Math</option>
            <option value="science">Science</option>
            <option value="english">English</option>
            <option value="french">French</option>
            <option value="geography">Geography</option>
            <option value="phys-ed">Phys Ed</option>
          </select>
        </div>

        <div class="form-group">
          <label for="grade">Grade</label>
          <select name="grade" id="grade">
            <option value=""></option>
            <option value="0">Pre-K or Kindergarden</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
          </select>
        </div>
        <input class="btn btn-submit" type="submit" name="search" value="Search">
      </form>
    </div>
        <?php
          if (isset($_POST['search'])) {
            $fieldsEntered = [
              !empty($_POST['first-name']),
              !empty($_POST['last-name']),
              !empty($_POST['school']),
              !empty($_POST['subject']),
              !empty($_POST['grade'])
            ];

            // Make this work!
            function queryTeachers () {
              $query = "SELECT * FROM filter_teachers WHERE ";
              $fNameEntered = FALSE;
              $lNameEntered = FALSE;
              $schoolEntered = FALSE;
              $subjectEntered = FALSE;
              $gradeEntered = FALSE;
                
              // First Name
              if (!empty($_POST['first-name'])) {
                $fNameEntered = TRUE;
                $first_name = $_POST['first-name'];
                $query .= "first_name LIKE '%" . $first_name . "%'";
              };
               
              // Last Name
              if (!empty($_POST['last-name'])) {
                $lNameEntered = TRUE;
                if ($fNameEntered) {
                  $query .= " AND";
                };
                $last_name = $_POST['last-name'];
                $query .= " last_name LIKE '%" . $last_name . "%'";
              };

              // School
              if (!empty($_POST['school'])) {
                $schoolEntered = TRUE;
                if (in_array(TRUE, [$fNameEntered, $lNameEntered])) {
                  $query .= " AND";
                };
                $school = $_POST['school'];
                $query .= " school = '$school'";
              };

              // Subject
              if (!empty($_POST['subject'])) {
                $subjectEntered = TRUE;
                if (in_array(TRUE, [$fNameEntered, $lNameEntered, $schoolEntered])) {
                  $query .= " AND";
                };
                $subject = $_POST['subject'];
                $query .= " subject = '$subject'";
              };

            // Grade
            if (!empty($_POST['grade'])) {
              $gradeEntered = TRUE;
              if (in_array(TRUE, [$fNameEntered, $lNameEntered, $schoolEntered, $subjectEntered])) {
                $query .= " AND";
              };
              $grade = $_POST['grade'];
              $query .= " grade = '$grade'";
            };
              
              echo "😎Your Query: $query <br><br>";
              return fetchTeachers($query);
            };
            
            if (in_array(1, $fieldsEntered)) {
            
              $qResults = queryTeachers();
              $length = count($qResults);
            
              echo "<table>
                      <thead>
                        <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>School</th>
                        <th>Subject</th>
                        <th>Grade</th>
                        </tr>
                        </thead>
                        <tbody>";

              for ($counter = 0; $counter < $length; $counter++) {
                $fName = $qResults["index $counter"]['first_name'];
                $lName = $qResults["index $counter"]['last_name'];
                $school = $qResults["index $counter"]['school'];
                $subject = $qResults["index $counter"]['subject'];
                $grade = $qResults["index $counter"]['grade'];
                echo "<tr>
                <td>$fName</td>
                <td>$lName</td>
                <td>$school</td>
                <td>$subject</td>
                <td>$grade</td>
                </tr>";
              };

              echo "</tbody>
                  </table>";
              echo "<button class='btn btn-excel'>Export to Excel</button>";
            };
          } else {

          };
        ?>
  </div>
  <footer>
    <p>Copyright &copy; 2023 Denzel Braithwaite</p>
  </footer>
  <script src="script.js"></script>
</body>
</html>
