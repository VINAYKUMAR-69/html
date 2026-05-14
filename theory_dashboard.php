<?php
$conn = new mysqli("localhost","root","","exam_seating");
if($conn->connect_error){ die("Connection failed: ".$conn->connect_error); }

// Fetch Theory Exam Students
$sql = "SELECT * FROM students WHERE exam_type='Theory'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Theory Exam Dashboard</title>
<style>
table { width: 100%; border-collapse: collapse; margin-top: 20px;}
th, td { border: 1px solid #ccc; padding: 10px; text-align: center;}
th { background: #007BFF; color: white; }
button { margin-top: 10px; padding: 10px 15px; background: green; color: white; border: none; border-radius: 5px; cursor:pointer;}
button:hover { background: darkgreen; }
</style>
</head>
<body>
<h2>Theory Exam Dashboard</h2>
<table>
<tr>
<th>Registration No</th><th>Name</th><th>Branch</th><th>Session</th><th>Exam Date</th>
</tr>
<?php
if($result->num_rows>0){
    while($row=$result->fetch_assoc()){
        echo "<tr>
        <td>{$row['student_id']}</td>
        <td>{$row['name']}</td>
        <td>{$row['branch']}</td>
        <td>{$row['session']}</td>
        <td>{$row['exam_date']}</td>
        </tr>";
    }
} else { echo "<tr><td colspan='5'>No students found</td></tr>"; }
?>
</table>
<button onclick="window.print()">Print Seating</button>
</body>
</html>
