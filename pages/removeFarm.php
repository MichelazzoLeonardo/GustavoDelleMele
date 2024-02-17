<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'classes/DB.php';
    if (isset($_POST['remove-name']) && isset($_POST['remove-owner'])) {
        $name = $_POST['remove-name'];
        $owner = $_POST['remove-owner'];

        $conn = DB::getConnection();
        $query = "DELETE FROM farm WHERE owner = '$owner' AND name = '$name';";
        $conn->query($query);
    }
}
header("Location:myFarms.php");