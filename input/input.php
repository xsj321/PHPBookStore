<?php
require_once "StudentsInputAdapter.php";
require_once "../Data/Student_DatabaseUtil.php";
if ($_POST)
{
    $user_ID = $_POST["user"];
}
$sdt =  new Student_DatabaseUtil();
$nowobj = $sdt->find_by_studentID("$user_ID");
$sia = new StudentsInputAdapter($nowobj[0]);
