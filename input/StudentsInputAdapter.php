<?php
require_once "../Data/Person_classes.php";
require_once "../Data/Student_DatabaseUtil.php";

class StudentsInputAdapter
{

    private $NowOBJ;
    public function __construct(Person_message $NowOBJ)
    {
        $this->NowOBJ = $NowOBJ;
        $this->dispaly();

    }

    private function dispaly(){
        $DBT = new Student_DatabaseUtil();
        $ID = $this->NowOBJ->getID();
        $NowAccount = $DBT->find_student_account_by_ID($ID);
        $Name = $this->NowOBJ->getName();
        $Sex = $this->NowOBJ->getSex();
        if ($Sex == '1')$Sex = '男';
        else $Sex = '女';
        $born = $this->NowOBJ->getBerth();
        $profession = $this->NowOBJ->getProfession();
        $mark = $this->NowOBJ->getMark();
        $other = $this->NowOBJ->getOther();
        echo <<<EOF
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>
        @import "input.css";
    </style>
</head>
<body>
    <form id="form" action="input_submit.php" method="post">
    <input  name="LastID" type="hidden" value="$ID" >
        <div class="input-box">
             <img class="back" src="../Res/back.png" onclick="back()">
             <div class="input-box-in">
                <div class="left-box">
                    <table class="input-table">
                        <tr>
                            <td>账号: </td>
                            <td> <input name="ID" type="text" value="$NowAccount"></td>
                        </tr>
                        <tr>
                            <td>学号: </td>
                            <td> <input name="studentID" type="text" value="$ID"></td>
                        </tr>
                        <tr>
                            <td>姓名: </td>
                            <td><input name="name" type="text" value="$Name"></td>
                        </tr>
                        <tr>
                            <td>性别: </td>
                            <td> <input name="sex" type="text" value="$Sex"></td>
                        </tr>
                    </table>
                     <br>
    
                </div>
    
                <div class="right-box">
                    <table class="input-table">
                        <tr>
                            <td>出生日期: </td>
                            <td><input name="birth" type="text" value="$born"></td>
                        </tr>
                        <tr>
                            <td>专业:</td>
                            <td> <input name="profession" type="text" value="$profession"></td>
                        </tr>
                        <tr>
                            <td>总学分: </td>
                            <td><input name="mark" type="text" value="$mark"></td>
                        </tr>
                        <tr>
                            <td>备注:</td>
                            <td> <input name="other" type="text" value="$other"></td>
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
        window.location.href = "http://127.0.0.1/BookStore/search/search.php";
    }
</script>
</body>
</html>
EOF;

    }

}