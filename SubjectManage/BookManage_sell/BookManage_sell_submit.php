<?php
session_start();
require_once "../Subject.php";
require_once "../SubjectManage_DataBaseUtil.php";
if ($_POST)
{
    $subjectID = $_POST["id"];
    $sellNum = $_POST["sell_num"];
    echo ($sellNum);
    $DBT = new SubjectManage_DataBaseUtil();
    $DBT->SellBook(
        $subjectID,
        $sellNum
    );
    header('Location: http://127.0.0.1/BookStore/SubjectManage/SubjectManage_home.php');
}
