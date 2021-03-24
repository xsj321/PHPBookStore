<?php session_start(); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>书籍管理系统</title>
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
                    echo "采购员";
                }
                ?></a>
        </div>
        <div class="logo">
            <img src="../Res/logo.png">
        </div>
    </div>
    <div class="main_area" align="center">
        <div align="center" class="logo_div">
            <img src="../Res/logo.png" class="search_logo">
        </div>
        <form method="post" action="/BookStore/Message/message.php">
            <div style="position: relative">
                <select name="type" class="select_in">
                    <option id="name" selected="selected">按人员检索</option>
                    <option id="profession" >按类别检索</option>
                    <option id="class">按书籍检索</option>
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