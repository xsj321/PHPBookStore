<?php
session_start();
require_once "../Subject.php";
require_once "../SubjectManage_DataBaseUtil.php";
if ($_POST) {
    $subjectID = $_POST["subjectID"];
    $subjectName = $_POST["subjectName"];
    $subjectTerm = $_POST["subjectTerm"];
    $subjectTime = $_POST["subjectTime"];
    $subjectMark = $_POST["subjectMark"];
    $DBT = new SubjectManage_DataBaseUtil();
    $DBT->AddSubject(
        new Subject(
            $subjectID,
            $subjectName,
            $subjectTerm,
            $subjectTime,
            $subjectMark
        ));
    header('Location: http://127.0.0.1/studentsSelect/SubjectManage/SubjectManage_home.php');
}
