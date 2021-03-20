<?php
session_start();
require_once "../Data/Student_DatabaseUtil.php";
require_once "../Data/Person_message.php";
if ($_POST)
{
    $Account = $_POST["ID"];
    $Password = $_POST["passwd"];
    $ID = $_POST["studentID"];
    $Name = $_POST["name"];
    $Sex = $_POST["sex"];
    $born = $_POST["birth"];
    $profession = $_POST["profession"];
    $mark = $_POST["mark"];
    $other = $_POST["other"];
    $msgobj = new Person_message($Name,$ID,$Sex,$born,$profession,$mark,$other);
    $pdo = new Student_DatabaseUtil();
    $pdo->creat_student($msgobj,$Account,$Password);

    $lastSeach = $_SESSION["last_search"];
    $lastType = $_SESSION["last_type"];
    echo "<form  id='form1' name='form1' method='post' action='http://127.0.0.1/studentsSelect/Message/message.php'>
             <input type='hidden' name='person' value='$lastSeach'>
             <input type='hidden' name='order' value='专业'>
             <input type='hidden' name='type' value='$lastType'> 
            </form>
            <script type='text/javascript'>function load_submit(){document.form1.submit()}load_submit();</script>";

}