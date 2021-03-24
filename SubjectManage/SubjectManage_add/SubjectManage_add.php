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
                        <td>书籍名称: </td>
                        <td> <input name="BookName" type="text" value=""></td>
                    </tr>
                    <tr>
                        <td>采购数量: </td>
                        <td><input name="BookBuyNum" type="text" value=""></td>
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

