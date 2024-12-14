<?php
    error_reporting(0);
    include 'Includes/database.php';

    function getCourseNames($conn) : array {
        $query = "select courseCode, name from tblcourse";
        $result = $conn->query($query);
        $courseNames = array();
        if ($result->num_rows > 0 ){
            while ($row = $result->fetch_assoc()){
                $courseNames[] = $row;
            }
        }
        return $courseNames;
    } 
    function getFacultyNames($conn) :  array {
        $query = "select facultyCode, facultyName from tblfaculty";
        $result = $conn->query($query);
        $facultyNames = array();
        if ($result->num_rows > 0 ){
            while ($row = $result->fetch_assoc()){
                $facultyNames[] = $row;
            }
        }
        return $facultyNames;
    }
    if (isset($_POST['addStudent'])){
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $registrationNumber = $_POST['registrationNumber'];
        $courseCode = $_POST['courseCode'];
        $faculty = $_POST['faculty'];
        $dateRegistered = $_POST['dateRegistered'];

        $capturedImage1 = $_POST['capturedImage1'];
        $capturedImage2 = $_POST['capturedImage2'];
        $base64Data1 = explode(separator: ',', string: $capturedImage1)[1]; // explode chia chuoi thanh 2 phan Phần trước dấu phẩy: "data:image/png;base64"
        $base64Data2 = explode(separator: ',', string: $capturedImage2)[1]; // Phần sau dấu phẩy: "iVBORw0KGgoAAAANSUhEUgAAA..."
        $imageData1 = base64_decode(string: $base64Data1);
        $imageData2 = base64_decode(string: $base64Data2);

        $registrationNumber = mysqli_real_escape_string($conn, string: $_POST['registrationNumber']);
        $folderPath = "../Lecture/lables.{$registrationNumber}/";

        if (!file_exists(filename: $folderPath)) {
            mkdir(directory: $folderPath, permissions: 0777, recursive: true);
        }
        file_put_contents($folderPath . '1.png', $imageData1);
        file_put_contents($folderPath . '2.png', $imageData2);

        $query = mysqli_query($conn, "select * from tblsstudents where registrationNumber = '$registrationNumber' ");
        $ret = mysqli_fetch_array($query);

        if ($ret > 0) {
            $message = "Student with the give Registration No: $registrationNumber Exists!";
        }
        else {
            $query = mysqli_query($conn, "insert into tblstudents(firstName, lastName, email, registrationNumber, faculty, courseCode, studentImage1, studentImage2, dateRegistered)
                                                         values ('$firstName', '$lastName', '$email', '$registrationNumber', '$faculty', '$courseCode', '$registrationNumber" . " _image1.png ', '$registrationNumber" . " _image1.png ', '$dateRegistered') " );
            $message = "Student: $registrationNumber has been successfully added to the class. ";
        }
    }

    if (isset($_POST['update'])){
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $registrationNumber = $_POST['registrationNumber'];
        $classId = $_POST['classId'];
        $classArmId = $_POST['classArmId'];
        $dateCreated = date(format: "Y-m-d");

        $query = mysqli_query($conn, "update tblstudents set firstName = '$firstName', lassName = '$lastName', 
        email = '$email', registrationNumber = '$registrationNumber', password = '12345', classId = '$classId', classArmId = '$classArmId' where Id = '$Id");
        if ($query) {
            echo "<script type = \"text/javascript\">
            window.location = (\"createStudents.php\")
            </script>"; 
        }
        else {
            $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>An error Occurred!</div>";
        }
    }

    if (isset($_GET['Id']) && isset($_GET['action']) && $_GET['action'] == "delete" ) {
        $Id = $_GET['Id'];
        $classArmId = $_GET['classArmId'];
        $query = mysqli_query($conn, "delete from tblstudents where Id = '$Id'");

        if ($query == true) {
            echo "<script type = \"text/javascript\">
                window.location = (\"createStudents.php\")
                </script>";
        }
        else {
            $statusMsg = "<div class='alert alert-danger' style='margin-right:700px;'>An error Occurred!</div>"; 
        }
    }
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
    <title>Face Recognition - Students</title>
</head>
<body>
    <?php include 'Includes/topHeader.php' ?>
    
    <section class="main">

        <?php include 'Includes/sidebarHeader.php' ?>

        <div class="main-content">
            <div id="overlay"></div>
            <div id="messageDiv" class="messageDiv" style="display:none;"></div>
            
            <div class="table-main">
                <div class="title" id="addStudent">
                    <h2>Students</h2>
                    <button class="add-item"><i class="la la-plus"></i>Add Student</button>
                </div>
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
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="addStudentForm" style="display: none;">
                <!-- method(post): them du lieu vao http, enctype: du lieu vao http se dc ma hoa -->
                <form class="form fstudent" action="" method="POST">
                    <div class="form-title">
                        <p class="p">Add Student</p>
                        <span class="btnClose">&times;</span> 
                        <!-- &time; : Ki hieu cho dau x --> 
                    </div>
                    <!-- required : bat buoc -->
                    <div class="input-form">
                        <input type="text" name="firstName" placeholder="First Name" value="<?php ?>" required>
                        <input type="text" name="lastName" placeholder="Last Name" value="<?php ?>"  required>
                        <input type="email" name="email" placeholder="Email Address" value="<?php ?>" required>
                        <input type="text" name="regisNumber" placeholder="Registration Number" value="<?php ?>"  required>
                        <span class="span">----------    ----------</span>
                    </div>
                    <div class="input-form">
                        <select name="faculty" id="" required>
                            <option value="" selected>Select Faculty</option>
                            <?php
                                $facultyNames = getFacultyNames($conn);
                                foreach ($facultyNames as $faculty ) {
                                    echo '<option value= " ' . $faculty["facultyCode"] . '" > ' . $faculty['facultyName'] . '</option>';
                                }
                            ?>
                        </select>
                        <select name="course" id="" required>
                            <option value="" selected>Select Course</option>
                            <?php
                                $courseNames = getCourseNames($conn);
                                foreach ($courseNames as $course ) {
                                    echo '<option value= " ' . $course["courseCode"] . '" > ' . $course['name'] . '</option>';
                                }
                            ?>
                        </select> 
                        <p class="p img-p">Take Student Pictures</p>
                    </div>
                    <div class="image-form input-form">
                        <div class="imgbox" onclick="openCamera('btn1');">
                            <img src="img/default.png" alt="Default Image" id="btn1-stu-img">
                            <div class="edit-icon">
                                <i class="la la-camera" onclick="openCamera('btn1');"></i>
                            </div>
                            <input type="hidden" id="btn1-stu-img-input" name="stuImg1">
                        </div>
                        <div class="imgbox" onclick="openCamera('btn2');">
                            <img src="img/default.png" alt="Default Image" id="btn2-stu-img">
                            <div class="edit-icon">
                                <i class="la la-camera" onclick="openCamera('btn2');"></i>
                            </div>
                            <input type="hidden" id="btn2-stu-img-input" name="stuImg2">
                        </div>
                    </div>
                    <div class="input-form">
                        <span class="span">----------    ----------</span>
                    </div>
                    <div class="input-form img-save">
                        <?php
                            if (isset($Id)){
                        ?>
                            <button type="submit" name="update" value="">Update</button>;
                        <?php
                            }
                            else {
                        ?>
                            <input type="submit" name="addStudent" class="submit" value="Save Student">;
                        <?php
                            }
                        ?>
                    </div>
                </form>

            </div>

        </div>
        
    </section>
    
    <script src="js/main.js"></script>
    <script src="js/addStudent.js"></script>
    <script src="js/confirmt.js"></script>

</body>
</html>