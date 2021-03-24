<?php
session_start();
require_once "../Book.php";
require_once "../SubjectManage_DataBaseUtil.php";
if ($_POST) {
    $BookName = $_POST["BookName"];
    $BookBuyNum = $_POST["BookBuyNum"];
    $DBT = new SubjectManage_DataBaseUtil();
    $DBT->AddBook(
        new Book(
            $BookName,
            $BookBuyNum
        ));
    header('Location: http://127.0.0.1/BookStore/SubjectManage/SubjectManage_home.php');
}
