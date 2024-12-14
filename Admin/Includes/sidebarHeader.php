<div class="sidebar">
    <ul class="sidebar-items">
        <li>
            <a href="index.php">
                <span class="icon la la-th-large"></span>
                <span class="sidebar-item">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="addCourse.php">
                <span class="icon la la-database"></span>
                <span class="sidebar-item">Manage Courses</span>
            </a>
        </li>
        <li>
            <a href="addVenue.php">
                <span class="icon la la-map-marker"></span>
                <span class="sidebar-item">Manage Venue</span>
            </a>
        </li>
        <li>
            <a href="addLecture.php">
                <span class="icon la la-user-tie"></span>
                <span class="sidebar-item">Manage Lectures</span>
            </a>
        </li>
        <li>
            <a href="addStudent.php">
                <span class="icon la la-user"></span>
                <span class="sidebar-item">Manage Students</span>
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