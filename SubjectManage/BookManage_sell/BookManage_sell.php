<?php
session_start();
if ($_POST)
{
    $subjectID = $_POST["subjectID"];
    $_SESSION["LastSubjectID"] = $subjectID;
    $subjectName = $_POST["subjectName"];
    $subjectTerm = $_POST["subjectTerm"];
    $subjectTime = $_POST["subjectTime"];

    echo <<<EOF
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>
        @import "BookManage_sell.css";
    </style>
</head>
<body>
    <form id="form" action="BookManage_sell_submit.php" method="post">
        <input type="hidden" name="id" value=$subjectID>
        <div class="input-box">
        <img class="back" src="../Res/back.png" onclick="back()">
         <div class="input-box-in">
            <div class="left-box">
                <table class="input-table">
                    <tr>
                        <td>书籍编号: </td>
                        <td>$subjectID</td>
                    </tr>
                    <tr>
                        <td>书籍名称: </td>
                        <td>《 $subjectName 》</td>
                    </tr>
                    <tr>
                        <td>书籍库存: </td>
                        <td>$subjectTerm</td>
                    </tr>
                </table>
                 <br>

            </div>

            <div class="right-box">
                <table class="input-table">
                    <tr>
                        <td>销售总数: </td>
                        <td>$subjectTime</td>
                    </tr>
                    
                    <tr>
                        <td>出售数量: </td>
                        <td><input name="sell_num" type="text" value="1"></td>
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

