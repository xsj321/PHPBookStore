<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>学科管理</title>
    <style>
        @import "SubjectManage_home.css";
    </style>
</head>
<body>

<div class="header">
    <div class="back" onclick="OnBackClick()">
        <img  src="Res/back.png">
    </div>
    <div class="back" onclick="OnAddClick()">
        <img  src="Res/add.png">
    </div>
    <div class="search_box">
        <form id="search" action="" method="post">
            <img class="search_button" src="Res/Search.png" onclick="search()">
            <input name="subject_name" class="search_box_in" type="text" placeholder="输入书籍名称查找">

        </form>
    </div>
</div>
<div class="grid_box">
    <?php
    require_once "SubjectManage_DataBaseUtil.php";
    require_once "SubjectManage_Adapter.php";
    $DBT = new SubjectManage_DataBaseUtil();
    if($_POST)
    {
        new SubjectManage_Adapter($DBT->FindSubject_by_Name($_POST["subject_name"]));
    }
    else{
        new SubjectManage_Adapter($DBT->FindSubject_by_Name("%"));
    }
    ?>
</div>
<script src="SubjectManage_home.js"></script>
</body>
</html>
