<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <script src="https://unpkg.com/face-api.js"></script>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="icon" href="img/logoFaceWeb.png">

    <link rel="stylesheet" href="css/style.css">
    <title>Face Recognition - Lectures</title>
</head>
<body>
    <?php include 'Includes/topHeader.php' ?>
    
    <section class="main">

        <?php include 'Includes/sidebarHeader.php' ?>

        <div class="main-content">
            <div id="overlay"></div>
            <div id="messageDiv" class="messageDiv" style="display:none;"></div>

            <div class="table-main">
                <div class="title" id="addLecture">
                    <h2>Lectures</h2>
                    <button class="add-item"><i class="la la-plus"></i>Add Lecture</button>
                </div>
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
                                <?php ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="addLectureForm" style="display: none;">
                <!-- method(post): them du lieu vao http, enctype: du lieu vao http se dc ma hoa -->
                <form class="form" action="" method="POST" name="addLecture" enctype="multipart/form-data">
                    <div class="form-title">
                        <p class="p">Add Lecture</p>
                        <span class="btnClose">&times;</span> 
                        <!-- &time; : Ki hieu cho dau x --> 
                    </div>
                    <!-- required : bat buoc -->
                    <div class="input-form">
                        <input type="text" name="firstName" placeholder="First Name" required>
                        <input type="text" name="lastName" placeholder="Last Name" required>
                        <input type="email" name="email" placeholder="Email Address" required>
                        <input type="text" name="phonenumber" placeholder="Phone Number" required>
                        <input type="password" name="password" placeholder="********" required>
                        <span class="span">----------    ----------</span>
                    </div>
                    <div class="input-form">
                        <select name="faculty" id="" required>
                            <option value="" selected>Select Faculty</option>
                            <?php ?>
                        </select>
                        <input type="submit" name="addLecture" class="submit" value="Save Lecture">
                    </div>
                </form>
                
            </div>

        </div>

    </section>

    <script src="js/main.js"></script>
    <script src="js/addLecture.js"></script>
    <script src="js/confirmt.js"></script>

    <?php ?>
</body>
</html>
<!-- ====sua THONG TIN HOC VIEN==== -->
<section class="suathongtin" style="display: none;">
                <div class="header-info">
                    <h3>Profile</h3>
                    <button class="btnClose"><i class="las la-times"></i></button>
                </div>
                <form class="main-info">
                    <div class="img-face">
                        <img src="" alt="">
                    </div>
                    <div class="text-info">
                            <div>
                                <label for="idsua">ID:</label>
                                <input type="text" name="" id="idsua">
                            </div>
                            <div>
                                <label for="tensua">Họ và tên:</label>
                                <input type="number" name="" id="tensua">
                            </div>
                            <div>
                                <label for="gendersua">Giới tính:</label>
                                <input type="text" name="" id="gendersua">
                            </div>
                            <div>
                                <label for="datesua">Ngày sinh:</label>
                                <input type="date" name="" id="datesua">
                            </div>
                            <div>
                                <label for="emailsua">E-mail:</label>
                                <input type="email" name="" id="emailsua">
                            </div>
                            <div>
                                <label for="phonesua">Sđt:</label>
                                <input type="text" name="" id="phonesua" minlength="11" maxlength="11">
                            </div>
                            <div>
                                <label for="diachisua">Địa chỉ</label>
                                <input type="text" name="" id="diachisua">
                            </div>
                    </div>
                </form>
            </section>  