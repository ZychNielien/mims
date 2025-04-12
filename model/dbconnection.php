<?php

$con = new mysqli("localhost", "root", "", "mims");

if (!$con) {

    die(mysqli_error($con));
}

?>