<?php
require_once "../SubjectManage_DataBaseUtil.php";
if ($_POST)
{
    $ID = $_POST['subjectID'];
    $DBT = new SubjectManage_DataBaseUtil();
    $DBT->DeleteSubject_by_ID($ID);
    header('Location: http://127.0.0.1/studentsSelect/SubjectManage/SubjectManage_home.php');
}
