<?php

require_once "Person_message.php";
require_once "Person_classes.php";
require_once "Teacher_message.php";

class Student_DatabaseUtil
{
    private $NowPDO;
    private $dbms='mysql';     //数据库类型
    private $host='localhost'; //数据库主机名
    private $dbName='pxscj';    //使用的数据库
    private $user='root';      //数据库连接用户名
    private $pass='xsj08262334910';          //对应的密码
    function __construct()
    {
        $dsn="$this->dbms:host=$this->host;dbname=$this->dbName";
        try {
            $this->NowPDO = new PDO($dsn,$this->user,$this->pass,array(PDO::MYSQL_ATTR_INIT_COMMAND => "set names utf8"));
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }

    }

    public function find_by_studentID($ID,$order = "专业"){
        $sql = <<<EOF
select * from xsb where 学号 like "%$ID%" order by $order
EOF;

        if ($order == "专业"){
            $sql = $sql." DESC;";
        }
        else
        {
            $sql = $sql." DESC;";
        }

        $Person_object_List  = array();
        $res = $this->NowPDO->query($sql);
        $arr = $res->fetchAll(PDO::FETCH_ASSOC);
        foreach ($arr as $item){
            $classes = $this->findclass_by_studentID($item["学号"]);
            array_push($Person_object_List, new Person_message(
                $item["姓名"], $item["学号"], $item["性别"], $item["出生时间"], $item["专业"], $item["总学分"], $item["备注"],$classes
            ));

        }
        return $Person_object_List;
    }

    public function find_by_studentName($Name,$order){
        $sql = <<<EOF
select * from xsb where 姓名 like "%$Name%" order by $order
EOF;
        if ($order == "专业"){
            $sql = $sql." DESC;";
        }
        else
        {
            $sql = $sql.";";
        }
        $Person_object_List  = array();
        $res = $this->NowPDO->query($sql);
        $arr = $res->fetchAll(PDO::FETCH_ASSOC);
        foreach ($arr as $item){
            $classes = $this->findclass_by_studentID($item["学号"]);
            array_push($Person_object_List, new Person_message(
                $item["姓名"], $item["学号"], $item["性别"], $item["出生时间"], $item["专业"], $item["总学分"], $item["备注"],$classes
            ));

        }
        return $Person_object_List;
    }

    private function findclass_by_studentID($ID){
        $sql = <<<EOF
select * from cjb where 学号 = "$ID";
EOF;
        $res = $this->NowPDO->query($sql);
        $res_array = $res->fetchAll(PDO::FETCH_ASSOC);
        $Classes_object_List = array();
        foreach ($res_array as $item)
        {
            $grade = $item["成绩"];
            $classID= $item["课程号"];
            $sql = <<<EOF
select * from kcb where 课程号 = "$classID";
EOF;
            $inner_res = $this->NowPDO->query($sql);
            $inner_res_array = $inner_res->fetchAll(PDO::FETCH_ASSOC);
            $Now_class = $inner_res_array[0];
            array_push($Classes_object_List,new Person_classes(
                $Now_class["课程号"],
                $Now_class["课程名"],
                $Now_class["开课学期"],
                $Now_class["学时"],
                $Now_class["学分"],
                $grade
            ));
        }
        return $Classes_object_List;
    }

    public function find_profession_by_Name($Name,$order){
        $sql = <<<EOF
select * from xsb where 专业 like "%$Name%" order by $order
EOF;
        if ($order == "专业"){
            $sql = $sql." DESC;";
        }
        else
        {
            $sql = $sql.";";
        }
        $Person_object_List  = array();
        $res = $this->NowPDO->query($sql);
        $arr = $res->fetchAll(PDO::FETCH_ASSOC);
        foreach ($arr as $item){
            $classes = $this->findclass_by_studentID($item["学号"]);
            array_push($Person_object_List, new Person_message(
                $item["姓名"], $item["学号"], $item["性别"], $item["出生时间"], $item["专业"], $item["总学分"], $item["备注"],$classes
            ));

        }
        return $Person_object_List;
    }

    public function find_class_by_ID($ID,$order){
        $sql = <<<EOF
SELECT * FROM xsb WHERE 学号 =ANY(SELECT 学号 FROM cjb WHERE 课程号 LIKE "%$ID%") order by $order
EOF;
        if ($order == "专业"){
            $sql = $sql." DESC;";
        }
        else
        {
            $sql = $sql.";";
        }
        $Person_object_List  = array();
        $res = $this->NowPDO->query($sql);
        $arr = $res->fetchAll(PDO::FETCH_ASSOC);
        foreach ($arr as $item){
            $classes = $this->findclass_by_studentID($item["学号"]);
            array_push($Person_object_List, new Person_message(
                $item["姓名"], $item["学号"], $item["性别"], $item["出生时间"], $item["专业"], $item["总学分"], $item["备注"],$classes
            ));

        }
        return $Person_object_List;
    }

    public function find_class_by_Name($Name,$order){
        $sql = <<<EOF
SELECT * FROM xsb WHERE 学号 =ANY(SELECT 学号 FROM cjb WHERE 课程号 =any(select 课程号 from kcb where 课程名 like "%$Name%")) order by $order
EOF;
        if ($order == "专业"){
            $sql = $sql." DESC;";
        }
        else
        {
            $sql = $sql.";";
        }
        $Person_object_List  = array();
        $res = $this->NowPDO->query($sql);
        $arr = $res->fetchAll(PDO::FETCH_ASSOC);
        foreach ($arr as $item){
            $classes = $this->findclass_by_studentID($item["学号"]);
            array_push($Person_object_List, new Person_message(
                $item["姓名"], $item["学号"], $item["性别"], $item["出生时间"], $item["专业"], $item["总学分"], $item["备注"],$classes
            ));

        }
        return $Person_object_List;
    }

    public function update_student_by_ID($LastID,Person_message $msg_obj,$NewID){
        $ID = $msg_obj->getID();
        $Name = $msg_obj->getName();
        $Sex = $msg_obj->getSex();
        if ($Sex == "男")$Sex = "1";
        else $Sex = "0";
        $born = $msg_obj->getBerth();
        $profession = $msg_obj->getProfession();
        $mark = $msg_obj->getMark();
        $other = $msg_obj->getOther();
        $sql = <<<EOF
update xsb set 
学号 = "$ID",
姓名 = "$Name",
性别 = "$Sex",
出生时间 = "$born",
专业 = "$profession",
总学分 = "$mark",
备注 = "$other" 
where 学号 = "$LastID";
update students set ID = "$NewID" where studentnum = "$LastID";
update students set studentnum = "$ID" where studentnum = "$LastID";
EOF;

        $this->NowPDO->exec($sql);
    }

    public function find_teacher_by_ID($ID){
        $sql = <<<EOF
select * from teachers where teacherID = "$ID";
EOF;

        $res = $this->NowPDO->query($sql);
        $arr = $res->fetchAll(PDO::FETCH_ASSOC);
        $the_teacher = $arr[0];
        return new Teacher_message($the_teacher["teacherID"],$the_teacher["teacherName"],$the_teacher["isAdmin"],$the_teacher["other"]);
    }

    public function find_student_account_by_ID($ID){
        $sql = <<<EOF
SELECT * FROM students where studentnum = "$ID";
EOF;
        $res = $this->NowPDO->query($sql);
        $arr = $res->fetchAll(PDO::FETCH_ASSOC);
        $the_student_account = $arr[0]["ID"];
        return $the_student_account;
    }

    public function creat_student(Person_message $msg_obj,$NewID,$Passwd){
        $ID = $msg_obj->getID();
        $Name = $msg_obj->getName();
        $Sex = $msg_obj->getSex();
        if ($Sex == "男")$Sex = 1;
        else $Sex = 0;
        $born = $msg_obj->getBerth();
        $profession = $msg_obj->getProfession();
        $mark = $msg_obj->getMark();
        $other = $msg_obj->getOther();
        $sql = <<<EOF
insert into xsb values("$ID","$Name",$Sex,"$born","$profession",$mark,"$other"); 
insert into account values ("$NewID","$Passwd",false);
insert into students values ("$NewID","$ID");
EOF;
        echo  $sql;
        $this->NowPDO->exec($sql);
    }

    public function delete_student(Person_message $msgobj){
        $studentID = $msgobj->getID();
        $AccountID = $this->find_student_account_by_ID($studentID);
        $sql = <<<EOF
delete from xsb where 学号 = "$studentID";
delete from account where ID = "$AccountID";
EOF;
        $this->NowPDO->exec($sql);
    }

    public function setGrade($studentID,$subjectID,$grade){
        $sql = <<<EOF
update cjb set 成绩 = $grade where 学号 = "$studentID" and 课程号 = "$subjectID";
EOF;
        $this->NowPDO->exec($sql);

    }

}