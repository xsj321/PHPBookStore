<?php
    session_start();
?>


    <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <style type="text/css">
            @import "LoginPanel.css";
        </style>
        <title>登录</title>

    </head>
    <body>
    <div class="login_window">
        <div align="center">
            <img src="../Res/logo.png" class="logo">
        </div>

        <form action="" method="post" id="the_form">
            <div class="the_textbox">
                <p class="user_text">用户名：</p>
                <input placeholder="中文英文或数字" type="text" name="user" value="" class="user_box">
                <p class="user_text">密码:</p>
                <input placeholder="请输入密码" type="password" name="passwd" value="" class="user_box">
            </div>
            <div class="buttons">
                <input type="button" class="round_button colors" id="login" name="login" value="登录" onclick="OnLoginClick();">
            </div>
            <input type="hidden" name="is_login" id="is_login" value="true">
        </form>
    </div>
    <script src="LoginPanel.js"></script>
    </body>
    </html>
<?php
require_once "../Data/User_User_DataBaseUtil.php";
require_once "../Data/Teacher_message.php";
require_once "../Data/Student_DatabaseUtil.php";

function is_SU($ID){
    $db = new Student_DatabaseUtil();
    $tobj = $db->find_teacher_by_ID($ID);
    if ($tobj->getIsAdmin() == 1) return true;
    else return false;
}

if ($_POST) {
    $dbtool = new User_DataBaseUtil();
    $username = $_POST["user"];
    $passwd = $_POST["passwd"];
    if ($username == "" || $passwd == "") {
        echo "<script>alert('请输入用户名与密码');</script>";
        return;
    }
    if ($_POST["is_login"] == "false") {
        $dbtool->DB_insert($username, $passwd);
        echo "<script>alert('注册成功！');</script>";
    }
    elseif ($_POST["is_login"] == "true") {

        $ret = $dbtool->DB_read($username);
        $back_username = $ret["ID"];
        $back_passwd = $ret["password"];
        $is_admin = $ret["isTeacher"];
        if ($username == $back_username && $passwd == $back_passwd) {
            $_SESSION["username"] = $username;
            $_SESSION["admin"] = $is_admin?true:false;
            if ($is_admin){
                if (is_SU($back_username))
                    $_SESSION["SU_admin"] = true;
                else
                    $_SESSION["SU_admin"] = false;
            }
            else
            {
                $_SESSION["SU_admin"] = false;
            }

            echo "登录成功";
            header("location: ../search/search.php");
        } else {
            echo "<script>alert('账户或密码错误');</script>";
        }

    }
}