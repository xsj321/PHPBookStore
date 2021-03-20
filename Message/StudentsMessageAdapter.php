<?php
require_once "../Data/Person_message.php";

class StudentsMessageAdapter
{
    private $NowUser;
    private $is_admin;
    private $is_SU_admin;
    public function __construct()
    {
        $this->NowUser = $_SESSION["username"];
        $this->is_admin = $_SESSION["admin"];
        $this->is_SU_admin = $_SESSION["SU_admin"];
    }

    function setAdapter($objList)
    {
        if (empty($objList))
        {
            $this->display_notfind();
        }

        foreach ($objList as $row) {
            $this->display_message($row);
        }
    }

    public function display_notfind(){
        echo <<<EOF
<div class="notfound">
    <div class="notfound-img-div">
        <img class="notfound-img" src="../Res/NotFound.png">
    </div>
    <div class="notfound_text">没有查找到人员</div>
</div>
EOF;

    }

    private function display_message(Person_message $Person_message_obj)
    {
        $ID = $Person_message_obj->getID();
        $Name = $Person_message_obj->getName();
        $Sex = $Person_message_obj->getSex();
        if ($Sex == '1')$Sex = '男';
        else $Sex = '女';
        $born = $Person_message_obj->getBerth();
        $profession = $Person_message_obj->getProfession();
        $mark = $Person_message_obj->getMark();
        $other = $Person_message_obj->getOther();
        $classes = $Person_message_obj->getClasses();
        echo <<<EOF
<div class="tip">
    <form name='form1' id="from1" action="print_page.php" method="post">
        <input name="ID"  type="hidden" value="$ID">
    <div class="tip_header">
        <div class="tip_inner">
            <div class="fist">
            <a class="fist_row"><img src="../Res/Name.png" class="icon_name"><span>姓名：</span> $Name</a>
            <a class="fist_row"><img src="../Res/Num.png" class="studentID"><span>学号：</span> $ID</a>
            <a class="fist_row"><img src="../Res/print.png" class="icon_print"><span><input class="printButton" type="submit" value="打印"></span></a>
            </div>
            <br>
            <div>
                <a class="item"><span>性别:</span>$Sex</a>
                <a class="item"><span>专业:</span><a href="message.php?pro=$profession">$profession</a></a>
                <a class="item"><span>出生日期:</span>$born</a>
                <a class="item"><span>备注:</span>$other</a>
            </div>
            <br>
   </form>
EOF;
        $grade_sum = 0;
        $mark_sum = 0;
        foreach ($classes as $class) {
            $class_name = $class->getClassName();
            $class_ID = $class->getClassID();
            $class_mark = $class->getClassMark();
            $class_grade = $class->getGrade();
            $grade_sum += $class_grade;
            if ($class_grade >= 60) $mark_sum += $class_mark;
            echo <<<EOF
<br>
<div class="classes">
    <form action="../marksubject/marksubject.php" method="post">
        <div class="fist">
            <input name="studentID" type="hidden" value="$ID">
            <input name="studentName" type="hidden" value="$Name">
            <input name="subjectID" type="hidden" value="$class_ID">
            <input name="subjectName" type="hidden" value="$class_name">
            <input name="subjectGrade" type="hidden" value="$class_grade">
            <a class="fist_row"><span>课程名：</span> $class_name</a>
            <a class="fist_row"><span>课程号：</span> $class_ID</a>
        </div>
        <br>
        <div>
            <a class="class_item"><span>学分:</span>$class_mark 分</a>
            <a class="class_item"><span>成绩:</span>$class_grade</a>
EOF;
           if ($this->is_admin){
               echo <<<EOF
            <input class="class_item_mark" type="submit" value="打分">
EOF;

           }
            echo <<<EOF
            </div>
    </form>
</div>
EOF;
        }
        $ave = 0;
        if(count($classes)){
            $ave = $grade_sum / count($classes);
        }

        echo <<<EOF
</div>
        <br>
        <div class="fist">
            <a class="class_item"><span>总成绩：</span> $grade_sum 分</a>
            <a class="class_item"><span>平均成绩：</span> $ave 分</a>
            <a class="class_item"><span>总学分：</span> $mark_sum</a>
        </div>
EOF;

        if ($this->is_SU_admin)
        {
            echo <<<EOF
            <div class="opt_button">
                <a class="fist_row">
                <form action="../input/input.php" method="post"> 
                    <input name="user" type="hidden" value="$ID">
                    <input class="opt_button_submit" type="submit" value="修改">
                </form>
                </a>
                <a class="fist_row">
                <form action="../deletestudent/deletestudent_submit.php" method="post"> 
                    <input name="user" type="hidden" value="$ID">
                    <input class="opt_button_submit" type="submit" value="删除">
                </form>
                </a>
            </div>
            
            
EOF;
        }

        echo <<<EOF
    </div>
    <br>
</div>
<br>
EOF;

    }
}

