<?php
require_once "../Data/Student_DatabaseUtil.php";
require_once "../Data/Person_message.php";
require_once "StudentsMessageAdapter.php";
session_start();
$last_search = '';
if($_POST){
    $_SESSION["last_search"] = $_POST["person"];
    $_SESSION["last_type"] = $_POST["type"];
}
if (isset($_SESSION["last_search"]))
{
    $last_search = $_SESSION["last_search"];
}
else $last_search = '';
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>检索结果</title>
    <style type="text/css">
        @import "message.css";
    </style>
</head>
<body>
<div class="top">
    <img class="logo" src="../Res/search_logo.svg" onclick="window.location.href ='../search/search.php'">
    <form method="post" action="/BookStore/Message/message.php">
    <div class="search_box_in">
        <select name="type" class="select">
            <option id="name" selected="selected">按人员检索</option>
            <option id="profession" >按专业检索</option>
            <option id="class">按课程检索</option>
        </select>
            <input type="text" class="search_box" name="person" value="<?php echo $last_search?>"/>
    </div>
    <div class="buttons">
        <input type="submit"  class="search_button" value="">
    </div>
        <div class="order">
            <input type="radio" name="order" value="专业" checked="checked"><a class="order_radio">按专业排序</a><br>
            <input type="radio" name="order" value="学号"><a class="order_radio">按学号排序</a>
        </div>
    </form>
    <div class = now_user>
        <a>当前用户:<br><span><?php echo $_SESSION["username"];?></span></a>
        <a href="../Login/LoginPanel.php" style="color: gray;font-weight: bold">注销</a>
    </div>
</div>
<?php
if ($_SESSION["SU_admin"]){
    echo <<<EOF
<div class="menu">
    <div  class="menu_item" onclick="window.location.href= 'http://127.0.0.1/BookStore/addstudent/addstudent.html';">
        <img src="../Res/student.png"><a>新建学生信息</a>
    </div>
    <div class="menu_item">
        <img src="../Res/subject.png" onclick="window.location.href='http://127.0.0.1/BookStore/SubjectManage/SubjectManage_home.php';"><a>管理课程信息</a>
    </div>
</div>
EOF;
}
?>
<br>
<?php
if ($_POST||$_GET) {
    $db = new Student_DatabaseUtil();
    if ($_POST){
        $find = $_POST["person"];
        $type = $_POST["type"];
        $order = $_POST["order"];
        if ($find == ''){
            echo <<<EOF
<script>
alert("搜索不能为空");
location.href = '../search/search.php';
</script>
EOF;

        }
        if ($type == "按人员检索"){
            if (preg_match('/^[\x7f-\xff]+$/', $find)) {
                $res = $db->find_by_studentName($find,$order);
            } else {
                $res = $db->find_by_studentID($find,$order);
            }
        }
        else if($type == "按专业检索"){
            $res = $db->find_profession_by_Name($find,$order);
        }
        else if($type == "按课程检索"){
            if (preg_match('/^[\x7f-\xff]+$/', $find)) {
                $res = $db->find_class_by_Name($find,$order);
            } else {
                $res = $db->find_class_by_ID($find,$order);
            }

        }
    }
    else if($_GET){
        $find = $_GET["pro"];
        $res = $db->find_profession_by_Name($find,"学号");
    }
    $Adapter = new StudentsMessageAdapter();
    $Adapter->setAdapter($res);

} else {
    $Adapter = new StudentsMessageAdapter();
    $Adapter->display_notfind();
}
?>
</body>
</html>
