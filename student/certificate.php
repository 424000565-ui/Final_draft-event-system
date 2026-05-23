<?php
session_start();

include("../includes/db.php");

if(!isset($_SESSION['user_id'])){
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$query = "
SELECT users.name,
       events.title
FROM attendance
JOIN users ON attendance.user_id = users.id
JOIN events ON attendance.event_id = events.id
WHERE attendance.user_id='$user_id'
LIMIT 1
";

$result = mysqli_query($conn,$query);

$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>

<head>

<title>Certificate</title>

<style>

body{
    font-family:Arial;
    background:#f5f5f5;
}

.certificate{
    width:900px;
    margin:auto;
    margin-top:50px;
    background:white;
    padding:50px;
    border:10px solid orange;
    text-align:center;
}

h1{
    font-size:50px;
    color:orange;
}

h2{
    margin-top:40px;
    font-size:35px;
}

p{
    font-size:22px;
    margin-top:20px;
}

button{
    padding:12px 20px;
    background:orange;
    color:white;
    border:none;
    margin-top:30px;
    cursor:pointer;
    border-radius:5px;
}

a{
    display:inline-block;
    padding:12px 20px;
    background:gray;
    color:white;
    text-decoration:none;
    margin-top:20px;
    border-radius:5px;
}

.message{
    color:red;
    font-size:25px;
    margin-top:50px;
}

@media print{

    button{
        display:none;
    }

    a{
        display:none;
    }

}

</style>

</head>

<body>

<div class="certificate">

<?php if($row){ ?>

<h1>Certificate of Attendance</h1>

<p>This certificate is proudly presented to</p>

<h2>
<?php echo $row['name']; ?>
</h2>

<p>for attending the event</p>

<h2>
<?php echo $row['title']; ?>
</h2>

<p>Congratulations and Thank You!</p>

<button onclick="window.print()">
Print Certificate
</button>

<?php } else { ?>

<div class="message">
No attendance record found.
</div>

<?php } ?>

<br>

<a href="dashboard.php">
Back Dashboard
</a>

</div>

</body>
</html>