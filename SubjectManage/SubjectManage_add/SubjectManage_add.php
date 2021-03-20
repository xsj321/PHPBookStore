<?php
echo <<<EOF
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>
        @import "SubjectManage_add.css";
    </style>
</head>
<body>
    <form id="form"  action="SubjectManage_add_submit.php" method="post">
    <div class="input-box">
        <img class="back" src="../Res/back.png" onclick="back()">
        <div class="input-box-in">
            <div class="left-box">
                <table class="input-table">
                    <tr>
                        <td>课程号: </td>
                        <td> <input name="subjectID" type="text" value=""></td>
                    </tr>
                    <tr>
                        <td>课程名称: </td>
                        <td> <input name="subjectName" type="text" value=""></td>
                    </tr>
                    <tr>
                        <td>开课学期: </td>
                        <td><input name="subjectTerm" type="text" value=""></td>
                    </tr>
                </table>
                 <br>
            </div>

            <div class="right-box">
                <table class="input-table">
                    <tr>
                        <td>课程学时: </td>
                        <td><input name="subjectTime" type="text" value=""></td>
                    </tr>
                    <tr>
                        <td>课程学分:</td>
                        <td> <input name="subjectMark" type="text" value=""></td>
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
        window.location.href = "http://127.0.0.1/BookStore/search/search.php"
    }
</script>
</body>
</html>
EOF;

