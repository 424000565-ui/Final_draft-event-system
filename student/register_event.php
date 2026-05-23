<?php
session_start();
include("../includes/db.php");

if(!isset($_SESSION['user_id'])){
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if(isset($_GET['id'])){

    $event_id = $_GET['id'];

    // CHECK IF ALREADY REGISTERED
    $check = mysqli_query($conn,
    "SELECT * FROM registrations 
    WHERE user_id='$user_id' 
    AND event_id='$event_id'");

    if(mysqli_num_rows($check) > 0){

        echo "
        <script>
        alert('Already Registered');
        window.location='dashboard.php';
        </script>
        ";

        exit();
    }

    // INSERT INTO REGISTRATIONS
    mysqli_query($conn,
    "INSERT INTO registrations(user_id,event_id)
    VALUES('$user_id','$event_id')");

    // INSERT INTO ATTENDANCE
    mysqli_query($conn,
    "INSERT INTO attendance(user_id,event_id,status,attendance_date)
    VALUES('$user_id','$event_id','Present',NOW())");

    echo "
    <script>
    alert('Event Registered Successfully');
    window.location='my_events.php';
    </script>
    ";

}else{

    echo "
    <script>
    alert('No Event ID Found');
    window.location='dashboard.php';
    </script>
    ";
}
?>