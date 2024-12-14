<div class="sidebar">
    <ul class="sidebar-items">
        <li>
            <a href="index.php">
                <span class="icon la la-clipboard-list"></span>
                <span class="sidebar-item">Take Attendance</span>
            </a>
        </li>
        <li>
            <a href="sbViewAtt.php">
                <span class="icon la la-user-check"></span>
                <span class="sidebar-item">View Attendance</span>
            </a>
        </li>
        <li>
            <a href="sbViewStudent.php">
                <span class="icon la la-user"></span>
                <span class="sidebar-item">Students</span>
            </a>
        </li>
        <li>
            <a href="sbDownloadRecord.php">
                <span class="icon la la-file-download"></span>
                <span class="sidebar-item">Download Attendance</span>
            </a>
        </li>
    </ul>
    <ul class="sidebar-other">
        <li>
            <a href="#">
                <span class="icon la la-cogs"></span>
                <span class="sidebar-item">Settings</span>
            </a>
        </li>
        <li>
            <a href="../Logout.php">
                <span class="icon la la-sign-out-alt"></span>
                <span class="sidebar-item">Logout</span>
            </a>
        </li>
    </ul>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function(){ // dam bao cac the html deu duoc tai xong
        var currentUrl = window.location.href; // lay url hien tai
        var links = document.querySelectorAll('.sidebar a'); // lay cac the a trong sidebar
        links.forEach(function(link) { // lap lai tat ca ca link trong the a
            if (link.href === currentUrl) { // so sanh voi the hien tai
                link.id = 'active-link' // tro den trang hien tai
            }
        })
    })
</script>