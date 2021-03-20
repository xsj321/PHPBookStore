<?php
session_start();
require_once "../Data/Student_DatabaseUtil.php";
if ($_POST){
    echo <<<EOF
<script>
let res = alert("删除成功");
</script>
EOF;
    $STUDENT = $_POST['user'];
    $DBT = new Student_DatabaseUtil();
    $res = $DBT->find_by_studentID($STUDENT);
    $DBT->delete_student($res[0]);
    $lastSeach = $_SESSION["last_search"];
    $lastType = $_SESSION["last_type"];
    echo "<form  id='form1' name='form1' method='post' action='http://127.0.0.1/studentsSelect/Message/message.php'>
             <input type='hidden' name='person' value='$lastSeach'>
             <input type='hidden' name='order' value='专业'>
             <input type='hidden' name='type' value='$lastType'>
            </form>
            <script type='text/javascript'>function load_submit(){document.form1.submit()}load_submit();</script>";
}