<?php
$conn = new mysqli("localhost","root","","exam_seating");

$sql = "SELECT students.name, students.branch, lab_allocations.lab_type, lab_allocations.session 
        FROM lab_allocations 
        JOIN students ON lab_allocations.student_id=students.student_id";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Lab Exam Dashboard</title>
<style>
table { width: 100%; border-collapse: collapse; margin-top: 20px;}
th, td { border: 1px solid #ccc; padding: 10px; text-align: center;}
th { background: #007BFF; color: white; }
button { margin-top: 10px; padding: 10px 15px; background: green; color: white; border: none; border-radius: 5px; cursor:pointer;}
button:hover { background: darkgreen; }
</style>
</head>
<body>
<h2>Lab Exam Dashboard</h2>
<table>
<tr><th>Name</th><th>Branch</th><th>Lab Type</th><th>Session</th></tr>
<?php
if($result->num_rows>0){
    while($row=$result->fetch_assoc()){
        echo "<tr>
        <td>{$row['name']}</td>
        <td>{$row['branch']}</td>
        <td>{$row['lab_type']}</td>
        <td>{$row['session']}</td>
        </tr>";
    }
} else { echo "<tr><td colspan='4'>No lab students found</td></tr>"; }
?>
</table>
<button onclick="window.print()">Print Lab Seating</button>
</body>
</html>
