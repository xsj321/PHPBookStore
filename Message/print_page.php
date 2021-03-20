<html>
<head>
    <style type="text/css">
        @import "print_page.css";
    </style>
</head>
<body>
<?php
require_once "../Data/Student_DatabaseUtil.php";
require_once "../Data/Person_message.php";
require_once "StudentsMessageAdapter.php";

function Print_message(Person_message $Person_message_obj)
{
    $ID = $Person_message_obj->getID();
    $Name = $Person_message_obj->getName();
    $Sex = $Person_message_obj->getSex();
    if ($Sex == '1') $Sex = '男';
    else $Sex = '女';
    $born = $Person_message_obj->getBerth();
    $profession = $Person_message_obj->getProfession();
    $mark = $Person_message_obj->getMark();
    $other = $Person_message_obj->getOther();
    $classes = $Person_message_obj->getClasses();
    echo <<<EOF
<div class="tip">
    <form name='form1' action="print_page.php" method="post">
    <input type="hidden" value="$ID">
    <div class="tip_header">
        <div class="tip_inner">
            <div class="fist">
            <a class="fist_row"><img src="../Res/Name.png" class="icon_name"><span>姓名：</span> $Name</a>
            <a class="fist_row"><img src="../Res/Num.png" class="studentID"><span>学号：</span> $ID</a>
            </div>
            <br>
            <div>
                <a class="item"><span>性别:</span>$Sex</a>
                <a class="item"><span>专业:</span>$profession</a>
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
    <div class="fist">
        <a class="fist_row"><span>课程名：</span> $class_name</a>
        <a class="fist_row"><span>课程号：</span> $class_ID</a>
    </div>
    <br>
    <div>
        <a class="class_item"><span>学分:</span>$class_mark 分</a>
        <a class="class_item"><span>成绩:</span>$class_grade</a>
    </div>
</div>
EOF;
    }
    $ave = $grade_sum / count($classes);
    echo <<<EOF
</div>
        <br>
        <div class="fist">
            <a class="class_item"><span>总成绩：</span> $grade_sum 分</a>
            <a class="class_item"><span>平均成绩：</span> $ave 分</a>
            <a class="class_item"><span>总学分：</span> $mark_sum</a>
        </div>
    </div>
    <br>
</div>
<br>
EOF;

}

if ($_POST) {
    $ID = $_POST['ID'];
    $db = new Student_DatabaseUtil();
    $NowOBJ = $db->find_by_studentID($ID,"学号");
    Print_message($NowOBJ[0]);
}
?>
<script>
    print();
</script>
</body>
</html>

