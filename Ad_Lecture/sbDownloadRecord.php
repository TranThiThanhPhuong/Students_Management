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
    <title>Face Recognition - Download Record</title>
</head>
<body>

    <?php include 'Includes/topHeader.php' ?>
    
    <section class="main">

        <?php include 'Includes/sidebar.php' ?>

        <div class="main-content">
            <div id="messageDiv" class="messageDiv"  style="display:none;" > </div>
            <form action="" class="lecture-form" id="select-form">
                <div class="input-form">
                    <select name="course" id="select-course" onchange="updateTable()" required>
                        <option value="" selected>Select Course</option>
                        <?php ?>

                    </select>
                    <select name="unit" id="select-unit" onchange="updateTable()" required>
                        <option value="" selected>Select Course</option>
                        <?php ?>
                        
                    </select>
                </div>
            </form>

            <div class="btn-att">
                <button class="add" onclick="exportTableToExcel('attendaceTable', '<?php ?>_on_<?php ?>','<?php ?>', '<?php ?>')">Export Attendance As Excel <i class="la la-file-download"></i> </button>
            </div>

            <div class="table-main">
                <div class="title">
                    <h2>Attendancde Preview</h2>
                </div>
                <div class="table-items table-att" id="table-att">
                    <table>
                        <thead>
                            <tr>
                                <th>Recognition No</th>
                                <?php ?>
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

        </div>

    </section>

    <script src="js/main.js"></script>
    <script src="js/jsmain.js"></script>
</body>
</html>