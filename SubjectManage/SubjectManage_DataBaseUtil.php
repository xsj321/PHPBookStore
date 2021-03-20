<?php
require_once "Subject.php";

class SubjectManage_DataBaseUtil
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


    public function FindSubject_by_Name($Name){

            $sql = <<<EOF
select * from kcb where 课程名 LIKE "%$Name%";
EOF;
            $inner_res = $this->NowPDO->query($sql);
            $inner_res_array = $inner_res->fetchAll(PDO::FETCH_ASSOC);
            $Classes_object_List = array();
            foreach ($inner_res_array as $Now_class)
            {
                array_push($Classes_object_List,new Subject(
                    $Now_class["课程号"],
                    $Now_class["课程名"],
                    $Now_class["开课学期"],
                    $Now_class["学时"],
                    $Now_class["学分"]
                ));
            }
        return $Classes_object_List;
    }

    public function UpdateSubject($LastID,Subject $subject){
        $subjectID = $subject->getClassID();
        $subjectName = $subject->getClassName();
        $subjectTerm = $subject->getClassTerm();
        $subjectTime = $subject->getClassTime();
        $subjectMark = $subject->getClassMark();
        $sql = <<<EOF
update kcb set 
课程号 = "$subjectID",
课程名 = "$subjectName",
开课学期 = $subjectTerm,
学时 = $subjectTime,
学分 = $subjectMark 
where 课程号 = "$LastID";
EOF;
        echo $sql;
        $this->NowPDO->exec($sql);
    }

    public function AddSubject(Subject $subject){
        $subjectID = $subject->getClassID();
        $subjectName = $subject->getClassName();
        $subjectTerm = $subject->getClassTerm();
        $subjectTime = $subject->getClassTime();
        $subjectMark = $subject->getClassMark();
        $sql = <<<EOF
insert into kcb 
values(
       '$subjectID',
       '$subjectName',
       $subjectTerm,
       $subjectTime,
       $subjectMark
       );
EOF;
        echo $sql;
        $this->NowPDO->exec($sql);


    }

    public function DeleteSubject_by_ID($ID){
        $sql = <<<EOF
delete from kcb where 课程号 = "$ID";
EOF;
        echo $sql;
        $this->NowPDO->exec($sql);

    }
}