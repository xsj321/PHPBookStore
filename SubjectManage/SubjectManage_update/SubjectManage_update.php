<?php
session_start();
if ($_POST)
{
    $subjectID = $_POST["subjectID"];
    $_SESSION["LastSubjectID"] = $subjectID;
    $subjectName = $_POST["subjectName"];
    $subjectTerm = $_POST["subjectTerm"];
    $subjectTime = $_POST["subjectTime"];
    $subjectMark = $_POST["subjectMark"];

    echo <<<EOF
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>
        @import "SubjectManage_update.css";
    </style>
</head>
<body>
    <form id="form" action="SubjectManage_update_submit.php" method="post">
        <div class="input-box">
        <img class="back" src="../Res/back.png" onclick="back()">
         <div class="input-box-in">
            <div class="left-box">
                <table class="input-table">
                    <tr>
                        <td>课程号: </td>
                        <td> <input name="subjectID" type="text" value="$subjectID"></td>
                    </tr>
                    <tr>
                        <td>课程名称: </td>
                        <td> <input name="subjectName" type="text" value="$subjectName"></td>
                    </tr>
                    <tr>
                        <td>开课学期: </td>
                        <td><input name="subjectTerm" type="text" value="$subjectTerm"></td>
                    </tr>
                </table>
                 <br>

            </div>

            <div class="right-box">
                <table class="input-table">
                    <tr>
                        <td>课程学时: </td>
                        <td><input name="subjectTime" type="text" value="$subjectTime"></td>
                    </tr>
                    <tr>
                        <td>课程学分:</td>
                        <td> <input name="subjectMark" type="text" value="$subjectMark"></td>
                    </tr>
                </table>

                <br>
            </div>
        </div>
         <div class="accept" onclick="OnClick()">
            <span>√</span>
        </div>
        </div>

    </form>
    <script>
    function OnClick() {
        let form =  document.getElementById("form");
        form.submit();
    }

    function back() {
        window.location.href = "http://127.0.0.1/studentsSelect/search/search.php";
    }
</script>
</body>
</html>
EOF;
}

