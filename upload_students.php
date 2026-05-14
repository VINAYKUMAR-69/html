<?php
$conn = new mysqli("localhost","root","","exam_seating");
if($conn->connect_error){ die("Connection failed: ".$conn->connect_error); }

$message = "";

if(isset($_POST['submit'])){
    $fileName = $_FILES['file']['tmp_name'];
    if($_FILES['file']['size'] > 0){
        $file = fopen($fileName, "r");
        fgetcsv($file); // skip header row

        while(($column = fgetcsv($file, 10000, ",")) !== FALSE){
            $name = $column[0];
            $branch = $column[1];
            $exam_type = $column[2];
            $hall_ticket = $column[3];
            $exam_date = $column[4];
            $session = $column[5];

            $sql = "INSERT INTO students (name, branch, exam_type, hall_ticket, exam_date, session)
                    VALUES ('$name', '$branch', '$exam_type', '$hall_ticket', '$exam_date', '$session')";
            $conn->query($sql);
        }
        $message = "CSV Data Imported Successfully!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Upload Students CSV</title>
<style>
body { font-family: Arial, sans-serif; background: #f4f4f4; text-align:center; padding-top:50px; }
input[type=file]{ padding:10px; }
input[type=submit]{ padding:10px 20px; background:#007BFF; color:white; border:none; border-radius:5px; cursor:pointer;}
input[type=submit]:hover{ background:#0056b3; }
.message { color:green; margin-top:20px; }
</style>
</head>
<body>
<h2>Upload Students CSV</h2>
<form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="file" accept=".csv" required>
    <br><br>
    <input type="submit" name="submit" value="Upload">
</form>
<div class="message"><?php echo $message; ?></div>
</body>
</html>
