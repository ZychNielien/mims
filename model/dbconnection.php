<?php

$con = new mysqli("localhost", "root", "", "MIMS");

if (!$con) {

    die(mysqli_error($con));
}

?>