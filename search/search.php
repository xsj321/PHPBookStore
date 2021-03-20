<?php session_start(); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DDUPSS</title>
    <style type="text/css">
        @import "search.css";
    </style>
    <script type="javascript" src="search.js"></script>
</head>
<body>
    <div class="header">

        <div>
            <a class="header_title">用户：</a><br>
            <a><?php echo $_SESSION['username'] ?></a>
        </div>
        <div>
            <a class="header_title">用户权限：</a><br>
            <a><?php
                if($_SESSION['admin']){
                    if ($_SESSION['SU_admin']){
                        echo "超级管理员";
                    }
                    else{
                        echo "管理员";
                    }
                }
                else
                {
                    echo "学生";
                }
                ?></a>
        </div>
        <div class="logo">
            <img src="../Res/logo.png">
        </div>
    </div>
    <div class="main_area" align="center">
        <div align="center" class="logo_div">
            <img src="../Res/search_logo.svg" class="search_logo">
        </div>
        <form method="post" action="/studentsSelect/Message/message.php">
            <div style="position: relative">
                <select name="type" class="select_in">
                    <option id="name" selected="selected">按人员检索</option>
                    <option id="profession" >按专业检索</option>
                    <option id="class">按课程检索</option>
                </select>
                <input type="text" class="search_box" name="person">
                <input type="hidden" name="order" value="学号">
            </div>
            <div class="buttons">
                <input type="submit" class="search_button" value="查找学生信息">
            </div>
        </form>
    </div>
</body>
</html>