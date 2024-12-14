<?php
    include 'Includes/database.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <script src="https://unpkg.com/face-api.js"></script>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="icon" href="img/logoFaceWeb.png">

    <title>Face Recognition - Course</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'Includes/topHeader.php' ?>
    
    <section class="main">

        <?php include 'Includes/sidebarHeader.php' ?>

        <div class="main-content">
            <div id="overlay"></div>
            
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
                    <div class="card" id="addCourse">
                        <?php
                            $query = mysqli_query($conn, "select * from tblcourse");
                            $courses = mysqli_num_rows($query);
                        ?>
                        <div class="card-data">
                            <div class="card-main">
                                <button class="add-item"><i class="la la-plus"></i>Add Course</button>
                                <h2 class="free"><?php echo $courses?> Courses</h2>
                            </div>
                            <i class="la la-user"></i>
                        </div>
                    </div>
                    <div class="card" id="addUnit">
                        <?php 
                            $query = mysqli_query($conn, "select * from tblunit");
                            $units = mysqli_num_rows($query);
                        ?>
                        <div class="card-data">
                            <div class="card-main">
                                <button class="add-item"><i class="la la-plus"></i>Add Unit</button>
                                <h2 class="free"><?php echo $units ?> Units</h2>
                            </div>
                            <i class="la la-file-text"></i>
                        </div>
                    </div>
                    <div class="card" id="addFaculty">
                        <?php 
                            $query = mysqli_query($conn, "select * from tblfaculty");
                            $facultys = mysqli_num_rows($query);
                        ?>
                        <div class="card-data">
                            <div class="card-main">
                                <button class="add-item"><i class="la la-plus"></i>Add Faculty</button>
                                <h2 class="free"><?php echo $facultys ?> Faculties</h2>
                            </div>
                            <i class="la la-user-tie"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="table-main">
                <div class="title">
                    <h2>Courses</h2>
                </div>
                <div class="table-items">
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Faculty</th>
                                <th>Total Units</th>
                                <th>Total Students</th>
                                <th>Date Created</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
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
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="table-main">
                <div class="title">
                    <h2>Units</h2>
                </div>
                <div class="table-items">
                    <table>
                        <thead>
                            <tr>
                                <th>Unit Code</th>
                                <th>Name</th>
                                <th>Course</th>
                                <th>Total Student</th>
                                <th>Date Created</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $query = "SELECT c.name AS course_name,
                                                u.unitCode AS unit_code,
                                                u.name AS unit_name,
                                                u.dateCreated AS date_created,
                                                COUNT(s.Id) AS total_students
                                        FROM tblunit u
                                        LEFT JOIN tblcourse c ON u.courseID = c.ID
                                        LEFT JOIN tblstudents s ON c.courseCode = s.courseCode
                                        GROUP BY u.ID";
                                $result = $conn->query($query);
                                if ($result->num_rows > 0){
                                    while ($row = $result->fetch_assoc()){
                                        echo "<tr>";
                                        echo "<td>" . $row["unit_code"] . "</td>";
                                        echo "<td>" . $row["unit_name"] . "</td>";
                                        echo "<td>" . $row["course_name"] . "</td>";
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
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="table-main">
                <div class="title">
                    <h2>Faculty</h2>
                </div>
                <div class="table-items">
                    <table>
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Total Courses</th>
                                <th>Total Students</th>
                                <th>Total Lectures</th>
                                <th>Date Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $query = "SELECT f.facultyName AS faculty_name,
                                                f.facultyCode AS faculty_code,
                                                f.dateRegistered AS date_created,
                                                COUNT(DISTINCT c.ID) AS total_courses,
                                                COUNT(DISTINCT s.Id) AS total_students,
                                                COUNT(DISTINCT l.Id) AS total_lectures
                                        FROM tblfaculty f
                                        LEFT JOIN tblcourse c ON f.Id = c.facultyID
                                        LEFT JOIN tblstudents s ON f.facultyCode = s.faculty
                                        LEFT JOIN tbllecture l ON f.facultyCode = l.facultyCode
                                        GROUP BY f.Id";
                                $result = $conn->query($query);
                                if ($result->num_rows > 0){
                                    while ($row = $result->fetch_assoc()){
                                        echo "<tr>";
                                        echo "<td>" . $row["faculty_code"] . "</td>";
                                        echo "<td>" . $row["faculty_name"] . "</td>";
                                        echo "<td>" . $row["total_courses"] . "</td>";
                                        echo "<td>" . $row["total_students"] . "</td>";
                                        echo "<td>" . $row["total_lectures"] . "</td>";
                                        echo "<td>" . $row["date_created"] . "</td>";
                                        echo "<td><span><i class='la la-edit edit'></i><i class='la la-trash delete'></i></span></td>";
                                        echo "</tr>";
                                    }
                                }
                                else {
                                    echo "<tr><td colspan='6'>No records found</td></tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="divForm" id="addCourseForm" style="display: none;">
                <!-- method(post): them du lieu vao http, enctype: du lieu vao http se dc ma hoa -->
                <form class="form" action="" method="POST" name="addCourse" enctype="multipart/form-data">
                    <div class="form-title">
                        <p class="p">Add Course</p>
                        <span class="btnClose">&times;</span> 
                        <!-- &time; : Ki hieu cho dau x --> 
                    </div>
                    <!-- required : bat buoc -->
                    <div class="input-form">
                        <input type="text" name="courseName" placeholder="Course Name" required>
                        <input type="text" name="courseCode" placeholder="Course Code" required>
                        <span class="span">----------    ----------</span>
                    </div>
                    <div class="input-form">
                        <select name="faculty" id="" required>
                            <option value="" selected>Select Faculty</option>
                            <?php ?>
                        </select>
                        <input type="submit" name="addCourse" class="submit" value="Save Course">
                    </div>
                </form>
                
            </div>

            <div class="divForm" id="addUnitForm" style="display: none;">
                <!-- method(post): them du lieu vao http, enctype: du lieu vao http se dc ma hoa -->
                <form class="form" action="" method="POST" name="addUnit" enctype="multipart/form-data">
                    <div class="form-title">
                        <p class="p">Add Unit</p>
                        <span class="btnClose">&times;</span> 
                        <!-- &time; : Ki hieu cho dau x --> 
                    </div>
                    <!-- required : bat buoc -->
                    <div class="input-form">
                        <input type="text" name="unitName" placeholder="Unit Name" required>
                        <input type="text" name="unitCode" placeholder="Unit Code" required>
                        <span class="span">----------    ----------</span>
                    </div>
                    <div class="input-form">
                        <select name="lecture" id="" required>
                            <option value="" selected>Assign Lecture</option>
                            <?php ?>
                        </select>
                        <select name="course" id="" required>
                            <option value="" selected>Select Course</option>
                            <?php ?>
                        </select>
                        <input type="submit" name="addUnit" class="submit" value="Save Unit">
                    </div>
                </form>
                
            </div>

            <div class="divForm" id="addFacultyForm" style="display: none;">
                <!-- method(post): them du lieu vao http, enctype: du lieu vao http se dc ma hoa -->
                <form class="form" action="" method="POST" name="addLecture" enctype="multipart/form-data">
                    <div class="form-title">
                        <p class="p">Add Faculty</p>
                        <span class="btnClose">&times;</span> 
                        <!-- &time; : Ki hieu cho dau x --> 
                    </div>
                    <!-- required : bat buoc -->
                    <div class="input-form">
                        <input type="text" name="facultyName" placeholder="Faculty Name" required>
                        <input type="text" name="facultyName" placeholder="Faculty Code" required>
                        <span class="span">----------    ----------</span>
                    </div>
                    <div class="input-form">
                        <input type="submit" name="addFaculty" class="submit" value="Save Faculty">
                    </div>
                </form>
                
            </div>

        </div>

    </section>

    <script src="js/main.js"></script>
    <script src="js/addCourse.js"></script>
    <script src="js/confirmt.js"></script>

</body>
</html>