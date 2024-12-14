<?php
    include 'Includes/database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link rel="icon" href="img/logoFaceWeb.png">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.css" rel="stylesheet">

    <link rel="stylesheet" href="css/style.css">
    <title>Face Recognition - Dashboard</title>
</head>
<body>

    <?php include 'Includes/topHeader.php' ?>
    
    <section class="main">

        <?php include 'Includes/sidebarHeader.php' ?>

        <div class="main-content">
            <div class="overview">
                <div class="title-overview">
                    <h2>Overview</h2>
                    <select name="day" id="day" class="select-day">
                        <option value="today">Today</option>
                        <option value="lastweek">Last Week</option>
                        <option value="lastmonth">Last Month</option>
                        <option value="lastyear">Last Year</option>
                        <option value="alltime">All Time</option>
                    </select>
                </div>
                <div class="cards">
                    <div class="card">
                        <?php
                            $query = mysqli_query($conn, "select * from tblstudents");
                            $students = mysqli_num_rows($query);
                        ?>
                        <div class="card-data">
                            <div class="card-main">
                                <h3>Registered Students</h3>
                                <h2><?php echo $students?></h2>
                            </div>
                            <i class="la la-user"></i>
                        </div>
                    </div>
                    <div class="card">
                        <?php 
                            $query = mysqli_query($conn, "select * from tblunit");
                            $units = mysqli_num_rows($query);
                        ?>
                        <div class="card-data">
                            <div class="card-main">
                                <h3>Units</h3>
                                <h2><?php echo $units?></h2>
                            </div>
                            <i class="la la-file-text"></i>
                        </div>
                    </div>
                    <div class="card">
                        <?php 
                            $query = mysqli_query($conn, "select * from tblstudents");
                            $totalLecture = mysqli_num_rows($query);
                        ?>
                        <div class="card-data">
                            <div class="card-main">
                                <h3>Registered</h3>
                                <h2><?php echo $totalLecture ?></h2>
                            </div>
                            <i class="la la-user-tie"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="table-main">
                <a href="addLecture.php">
                    <div class="title">
                        <h2>Lectures</h2>
                        <button  class="add-item"><i class="la la-plus"></i>Add Lecture</button>
                    </div>
                </a>
                <div class="table-items">
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email Address</th>
                                <th>Phone No</th>
                                <th>Faculty</th>
                                <th>Date Registered</th>
                                <th>Settings</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php 
                                    $query = "SELECT l.*, f.facultyName 
                                            FROM tbllecture AS l 
                                            LEFT JOIN tblfaculty AS f ON l.facultyCode = f.facultyCode;";
                                    $result = $conn->query($query);
                                    if ($result->num_rows > 0){
                                        while ($row = $result->fetch_assoc()){
                                            echo "<tr>";
                                            echo "<td>" . $row["firstName"] . "</td>";
                                            echo "<td>" . $row["emailAddress"] . "</td>";
                                            echo "<td>" . $row["phoneNo"] . "</td>";
                                            echo "<td>" . $row["facultyName"] . "</td>";
                                            echo "<td>" . $row["dateCreated"] . "</td>";
                                            echo "<td><span><i class='la la-edit edit'></i><i class='la la-trash delete'></i></span></td>";
                                            echo "</tr>";
                                        }
                                    }
                                    else {
                                        echo "<tr><td colspan='6'>No records found</td></tr>";
                                    }
                                ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="table-main">
                <a href="addStudent.php">
                    <div class="title">
                        <h2>Student</h2>
                        <button class="add-item"><i class="la la-plus"></i>Add Student</button>
                    </div>
                </a>
                <div class="table-items">
                    <table>
                        <thead>
                            <tr>
                                <th>Registration No</th>
                                <th>Name</th>
                                <th>Faculty</th>
                                <th>Course</th>
                                <th>Email</th>
                                <th>Settings</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php 
                                    $query = "SELECT * 
                                    FROM tblstudents";
                                    $result = $conn->query($query);
                                    if ($result->num_rows > 0){
                                        while ($row = $result->fetch_assoc()){
                                            echo "<tr>";
                                            echo "<td>" . $row["registrationNumber"] . "</td>";
                                            echo "<td>" . $row["firstName"] . "</td>";
                                            echo "<td>" . $row["faculty"] . "</td>";
                                            echo "<td>" . $row["courseCode"] . "</td>";
                                            echo "<td>" . $row["email"] . "</td>";
                                            echo "<td><span><i class='la la-edit edit'></i><i class='la la-trash delete'></i></span></td>";
                                            echo "</tr>";
                                        }
                                    }
                                    else {
                                        echo "<tr><td colspan='6'>No records found</td></tr>";
                                    }
                                ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="table-main">
                <a href="addVenue.php">
                    <div class="title">
                        <h2>Lecture Rooms</h2>
                        <button class="add-item"><i class="la la-plus"></i>Add Room</button>
                    </div>
                </a>
                <div class="table-items">
                    <table>
                        <thead>
                            <tr>
                                <th>Class Name</th>
                                <th>Faculty</th>
                                <th>Current Status</th>
                                <th>Capacity</th>
                                <th>Classification</th>
                                <th>Settings</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php 
                                    $query = "SELECT * 
                                    FROM tblvenue";
                                    $result = $conn->query($query);
                                    if ($result->num_rows > 0){
                                        while ($row = $result->fetch_assoc()){
                                            echo "<tr>";
                                            echo "<td>" . $row["className"] . "</td>";
                                            echo "<td>" . $row["facultyCode"] . "</td>";
                                            echo "<td>" . $row["currentStatus"] . "</td>";
                                            echo "<td>" . $row["capacity"] . "</td>";
                                            echo "<td>" . $row["classification"] . "</td>";
                                            echo "<td><span><i class='la la-edit edit'></i><i class='la la-trash delete'></i></span></td>";
                                            echo "</tr>";
                                        }
                                    }
                                    else {
                                        echo "<tr><td colspan='6'>No records found</td></tr>";
                                    }
                                ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="table-main">
                <a href="addCourse.php">
                    <div class="title">
                        <h2>Courses</h2>
                        <button class="add-item"><i class="la la-plus"></i>Add Course</button>
                    </div>
                </a>
                <div class="table-items">
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Faculty</th>
                                <th>Total Units</th>
                                <th>Total Students</th>
                                <th>Date Created</th>
                                <th>Settings</th>
                                <!-- <th>Action</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php 
                                    $query = "SELECT c.name AS course_name,
                                                    c.facultyID AS faculty,
                                                    f.facultyName AS faculty_name,
                                                    COUNT(u.ID) AS total_units,
                                                    COUNT(DISTINCT s.Id) AS total_students,
                                                    c.dateCreated AS date_created
                                            FROM tblcourse c
                                            LEFT JOIN tblunit u ON c.ID = u.courseID
                                            LEFT JOIN tblstudents s ON c.courseCode = s.courseCode
                                            LEFT JOIN tblfaculty f on c.facultyID=f.Id
                                            GROUP BY c.ID";
                                    $result = $conn->query($query);
                                    if ($result->num_rows > 0){
                                        while ($row = $result->fetch_assoc()){
                                            echo "<tr>";
                                            echo "<td>" . $row["course_name"] . "</td>";
                                            echo "<td>" . $row["faculty_name"] . "</td>";
                                            echo "<td>" . $row["total_units"] . "</td>";
                                            echo "<td>" . $row["total_students"] . "</td>";
                                            echo "<td>" . $row["date_created"] . "</td>";
                                            echo "<td><span><i class='la la-edit edit'></i><i class='la la-trash delete'></i></span></td>";
                                            echo "</tr>";
                                        }
                                    }
                                    else {
                                        echo "<tr><td colspan='6'>No records found</td></tr>";
                                    }
                                ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </section>

    <script src="js/main.js"></script>
    <script src="js/addCourse.js"></script>
    <script src="js/addLecture.js"></script>
    <script src="js/addStudent.js"></script>
    <script src="js/addVenue.js"></script>
    <script src="js/confirmt.js"></script>

</body>
</html>