<?php
include("conn.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- เพิ่มส่วน ใช้งาน Bootstrap -->
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- ส่วนของ DataTable -->
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <!-- เพิ่มส่วน ใช้งาน Google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Itim&family=Kanit:ital,wght@0,200;0,300;1,100;1,200&family=Prompt:ital,wght@0,200;0,300;1,300&display=swap" rel="stylesheet">

    <!-- เพิ่ม CSS ให้ใช้ Font  -->
    <style>
        body {
            font-family: 'Kanit', sans-serif;
        }
    </style>
</head>

<body>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลพนักงาน</title>
    </head>

    <body>
        <?php
        if (isset($_GET['action_even']) == 'delete') {
            //echo "Test";

            $employee_id = $_GET['employee_id'];
            $sql = "SELECT * FROM employees WHERE employee_id=$employee_id";
            // echo $sql;
            $result = $conn->query($sql);
            // $lvsql =mysqli_query($conn,$sql);
            if ($result->num_rows > 0) {
                // sql to delete a record
                $sql = "DELETE FROM employees WHERE employee_id =$employee_id";

                if ($conn->query($sql) === TRUE) {
                    echo "<div class='alert alert-success'>ลบข้อมูลสำเร็จ</div>";
                } else {
                    echo "<div class='alert alert-danger'>ลบข้อมูลมีข้อผิดพลาด กรุราตรวจสอบ !!! </div>" . $conn->error;
                }
                // $conn->close();
            } else {
                echo 'ไม่พบข้อมูล กรุณาตรวจสอบ';
            }
        }
        ?>

        <h1>แสดงข้อมูลพนักงาน</h1>
        <h2>พัฒนาโดย 664485033 นางสาว กัญญากร จิวรรจนะโรดม</h2>

        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>รหัสพนักงาน</th>
                    <th>ชื่อพนักงาน</th>
                    <th>นามสกุล</th>
                    <th>ตำแหน่ง</th>
                    <th>เพศ</th>
                    <th>อายุ</th>
                    <th>เงินเดือน</th>
                    <th>จัดการข้อมูล</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM employees";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["employee_id"] . "</td>";
                        echo "<td>" . $row["first_name"] . "</td>";
                        echo "<td>" . $row["last_name"] . "</td>";
                        echo "<td>" . $row["department"] . "</td>";
                        echo "<td>" . $row["gender"] . "</td>";
                        echo "<td>" . $row["age"] . "</td>";
                        echo "<td>" . $row["salary"] . "</td>";

                        echo '<td><a type="button" href="show.php?action_even=del&employee_id=' . $row['employee_id'] . '" title="ลบข้อมูล" onclick="return confirm(\'ต้องการจะลบข้อมูลรายชื่อ ' . $row['employee_id'] . ' ' . $row['first_name'] . ' ' . $row['last_name'] . '?\')" class="btn btn-danger btn-sm"> ลบข้อมูล </a>  
                    
        <a type="button" href="edit.php?action_even=edit&employee_id=' . $row['employee_id'] . '" 
    title="แก้ไขข้อมูล" onclick="return confirm(\'ต้องการจะแก้ไขข้อมูลรายชื่อ ' . $row['employee_id'] . ' ' . $row['first_name'] . ' ' . $row['last_name'] . '?\')" class="btn btn-primary btn-sm"> แก้ไขข้อมูล </a> </td>';

                        echo "</tr>";
                    }
                } else {
                    echo "0 results";
                }
                $conn->close();
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>รหัสพนักงาน</th>
                    <th>ชื่อ</th>
                    <th>นามสกุล</th>
                    <th>อีเมล</th>
                    <th>เบอร์โทร</th>
                    <th>วันที่จ้างงาน</th>
                </tr>
            </tfoot>
        </table>
    </body>
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Java script -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <script>
        new DataTable('#example');
    </script>

</html>