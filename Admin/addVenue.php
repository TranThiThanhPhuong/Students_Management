<?php
    include 'Includes/database.php';

    function getFacultyName($conn):array {
        $query = "select facultyCode, facultyName from tblfaculty";
        $result = $conn->query($query);
        $facultyName =array();
        if ($result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                $facultyName[] = $row;
            }
        }
    return $facultyName;
    }
    
    if (isset($_POST['addVenue'])) {
        $className = $_POST['className'];
        $faculty = $_POST['faculty'];
        $currentStatus = $_POST["currentStatus"];
        $capacity=$_POST["capacity"];
        $classification=$_POST["classification"];
        $faculty=$_POST["faculty"];
        $dateRegistered = date(format: "Y-m-d");

        $query = mysqli_query($conn, query: "select * form tblvenue where className= '$className' ");
        $ret=mysqli_fetch_array($query);
        if($ret > 0){ 
            $message = " Venue Already Exists";
    }
    else{
            $query=mysqli_query($conn,"insert into tblvenue(className,facultyCode,currentStatus,capacity,classification,dateCreated) 
        value('$className','$facultyCode','$currentStatus','$capacity','$classification','$dateRegistered')");
        $message = " Venue Inserted Successfully";

    }
    }

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

    <title>Face Recognition - Venue</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'Includes/topHeader.php' ?>
    
    <section class="main">

        <?php include 'Includes/sidebarHeader.php' ?>

        <div class="main-content">
            <div id="overlay"></div>

            <div class="overview">
                <div class="title-overview title">
                    <h2>Rooms</h2>
                    <select name="day" id="day" class="select-day room-filter">
                        <option value="filter">Filter</option>
                        <option value="free">Free</option>
                        <option value="scheduled">Scheduled</option>
                    </select>
                    <button id="addClass1" class="add-item room"><i class="la la-plus"></i>Add Lecture Room</button>
                </div>
            </div>
            
            <div class="room-cards">
                <a href="#" class="room-card">
                    <div class="room-img">
                        <div class="room-imgbox">
                            <img src="img/office.png" alt="">
                        </div>
                    </div>
                    <p class="free">Office</p>
                </a>
                <a href="#" class="room-card">
                    <div class="room-img">
                        <div class="room-imgbox">
                            <img src="img/class.png" alt="">
                        </div>
                    </div>
                    <p class="free">Class</p>
                </a>
                <a href="#" class="room-card">
                    <div class="room-img">
                        <div class="room-imgbox">
                            <img src="img/lecture.png" alt="">
                        </div>
                    </div>
                    <p class="free">Lecture Hall</p>
                </a>
                <a href="#" class="room-card">
                    <div class="room-img">
                        <div class="room-imgbox">
                            <img src="img/compu.png" alt="">
                        </div>
                    </div>
                    <p class="free">Computer Lab</p>
                </a>
                <a href="#" class="room-card">
                    <div class="room-img">
                        <div class="room-imgbox">
                            <img src="img/scien.png" alt="">
                        </div>
                    </div>
                    <p class="free">Science Lab</p>
                </a>
            </div>

            <div id="messageDiv" class="messageDiv" style="display:none;"></div>

            <div class="table-main">
                <div class="title">
                    <h2>Lecture Rooms</h2>
                    <button id="addClass2" class="add-item"><i class="la la-plus"></i>Add Class</button>
                </div>
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
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="addRoomForm" style="display: none;">
                <!-- method(post): them du lieu vao http, enctype: du lieu vao http se dc ma hoa -->
                <form class="form" action="" method="POST" name="addVenue" enctype="multipart/form-data">
                    <div class="form-title">
                        <p class="p">Add Venue</p>
                        <span class="btnClose">&times;</span> 
                        <!-- &time; : Ki hieu cho dau x --> 
                    </div>

                    <!-- required : bat buoc -->
                    <div class="input-form">
                        <input type="text" name="className" placeholder="Class Name" required>
                        <select name="curentStatus" id="" required>
                            <option value="">--Current Status--</option>
                            <option value="">Available</option>
                            <option value="">Scheduled</option>
                        </select>
                        <input type="text" name="capacity" placeholder="Capacity" required>
                        <select required name="classification">
                            <option value="" selected> --Select Class Type--</option>
                            <option value="laboratory">Laboratory</option>
                            <option value="computerLab">Computer Lab</option>
                            <option value="lectureHall">Lecture Hall</option>
                            <option value="class">Class</option>
                            <option value="office">Office</option>
                        </select>
                        <span class="span">---------- ----------</span>
                    </div>

                    <div class="input-form">
                        <select name="faculty" id="" required>
                            <option value="" selected>Select Faculty</option>
                            <<?php 
                                $facultyname = getFacultyName($conn);
                                foreach ($facultyname as $faculty){
                                    echo '<option value="' . $faculty["facultyCode"] . '">' . $faculty["facultyName"] . '</option'; 
                                }
                            ?>
                        </select>
                        <input type="submit" name="addVenue" class="submit" value="Save Venue">
                    </div>
                </form>

            </div>

        </div>

    </section>
    <?php
        if(isset($message)){
            echo "<script>showMessage('" . $message . "');</script>";
        } 
    ?>
    <script src="js/main.js"></script>
    <script src="js/addVenue.js"></script>
    <script src="js/confirmt.js"></script>
</body>
</html>