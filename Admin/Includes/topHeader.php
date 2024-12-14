<?
    $fullName = "";
    if (isset($_SESSION['userId'])){ // kiem tra co ton tai khong
        $userId = $conn->real_escape_string($_SESSION['userId']); // Giá trị userId từ session được lấy và sử dụng trong truy vấn cơ sở dữ liệu., Hàm real_escape_string() được dùng để bảo vệ chống lại SQL injection.
        $query = "select * from tbladmin where Id = $userId";
        $result = $conn->query($query);
        if ($result) {
            $num = $result->num_rows;
            if ($num > 0) {
                $row = $result->fetch_assoc();
                $fullName = $row['firstName'] . " " . $row['lastName'];
            }
            else {
                echo "Admin not found";
            }
        }
        else {
            echo "Error: " . $conn->error;
        }
    }
    else {
        header('location: ../index.php'); // Nếu người dùng chưa đăng nhập (session userId không tồn tại), người dùng sẽ được chuyển hướng về trang đăng nhập (../index.php).
    }
?>

<section class="header">
    <div class="attendance">
        <i class="la la-bars icon menu"></i>
        <h2>Attendance</h2>
    </div> 
    <div class="header-right">
        <div id="searchInput" class="search-form">
            <input type="text" name="" id="textSearch" placeholder="Search .....">
            <button onclick="searchItems()"><i class="la la-search"></i>
            </button>
        </div>
        <div class="header-other">
            <div class="account">
                <!-- @ <?php echo $fullName ?> -->
            </div>
            <div class="profile">
                <img src="img/user.png" alt="">
            </div>
        </div>
    </div>
</section>

<script>
    function searchItems() { // hien nhung tu khoa do nguoi dung nhap vao co trong row, an tu khoa k co
        var input = document.getElementById('textSearch').value.toLowerCase(); //k phan biet chu thuong chu hoa khi search
        var rows = document.querySelectorAll('table tr'); // lay all tr trong table

        rows.forEach(function(row){ // lap qua tung row cua table
            var cells = row.querySelectorAll('td'); // lay td trong row 
            var found = false; 

            cells.forEach(function(cell){ // lap tung o cell trong row
                if (cell.innerText.toLowerCase().includes(input)){ // kt xem input co chua trong cell hay k
                    found = true; // row do se 
                }
            });
            if(found) {
                row.style.display = ''; // hien thi mac dinh
            }
            else {
                row.style.display = 'none'
            }
        });
    }
</script>