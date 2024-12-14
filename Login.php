<?php
    include 'Includes/database.php';
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" href="logoFaceWeb.png">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="css/LoginStyle.css">

    <title>LOGIN</title>
</head>
<body>
    <div class="container" id="signin">
        <h3>LOGIN</h3>
        <div id="messageDiv" class="messageDiv" style="display: none"></div>

        <form action="" method="post">
            <select name="typeUser" required>
                <option value="">--Select User Roles--</option>
                <option value="Administrator">Administrator</option>
                <option value="Lecture">Lecture</option>
            </select>

            <input type="email" name="email" placeholder="example@gmail.com">
            <input type="password" name="password" placeholder="password">
            
            <p class="recover">
                <a href="#">Recover Password</a>
            </p>

            <input type="submit" name="login" value="Login" class="btn-login">
        </form>

        <div class="orther">
            <p>-------or-------</p>
            <div class="icons">
                <i class="fab fa-google"></i>
                <i class="fab fa-facebook"></i>
             </div>
        </div>
    </div>

    <script>
        function showMessage(message){
            var messageDiv =document.getElementById('messageDiv');
            messageDiv.style.display = "block";
            messageDiv.innerHTML =message;
            messageDiv.style.opacity = 1;
            setTimeout(function(){
                messageDiv.style.opacity = 0;
            }, 5000);
        }
    </script>

    <?php
        if (isset($_POST['login'])){ // name cua the tag
            $userType = $_POST['typeUser'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $password = md5($password);

            if ($userType == 'Administrator'){
                $query = "select * from tbladmin where emailAddress = '$email' and password = '$password'";
                $rs = $conn->query($query); // thuc hien truy van va luu vao rs
                $num = $rs->num_rows; // dem so hang trong  rs
                $rows = $rs->fetch_assoc(); // bo du lieu vao mot mang lien ket gan vao rows

                if ($num > 0){
                    $_SESSION['ID'] = $rows['Id']; // dang nhap duoc thi se luu id vao bien session
                    $_SESSION['firstName'] = $rows['firstName'];
                    $_SESSION['email'] = $rows['emailAddress'];

                    echo "<script type = \"text/javascript\"> 
                        window.location = (\"Admin/index.php\")
                        </script>"; // chuyen huong nguoi dung sang admin
                }
                else {
                    $message = "Invalid Username or Password!"; // sai thong tin dn
                    echo "<script>showMessage('" . $message . "')</script>";
                }

            }
            else if ($userType == 'Lecture'){
                $query = "select * from tbllecture where emailAddress = '$email' and password = '$password'";
                $rs = $conn->query($query); // thuc hien truy van va luu vao rs
                $num = $rs->num_rows; // dem so hang trong  rs
                $rows = $rs->fetch_assoc(); // bo du lieu vao mot mang lien ket gan vao rows

                if ($num > 0){
                    $_SESSION['ID'] = $rows['Id']; // dang nhap duoc thi se luu id vao bien session
                    $_SESSION['firstName'] = $rows['firstName'];
                    $_SESSION['email'] = $rows['emailAddress'];

                    echo "<script type = \"text/javascript\"> 
                        window.location = (\"Ad_Lecture/index.php\")
                        </script>"; // chuyen huong nguoi dung sang admin
                }
                else {
                    $message = "Invalid Username or Password!"; // sai thong tin dn
                    echo "<script>showMessage('" . $message . "')</script>";
                }
            }
        }
    ?>

</body>
</html>