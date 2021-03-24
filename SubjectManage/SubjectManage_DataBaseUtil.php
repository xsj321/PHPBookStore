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

    function console_log($data)
    {
        if (is_array($data) || is_object($data))
        {
            echo("<script>console.log('".json_encode($data)."');</script>");
        }
        else
        {
            echo("<script>console.log('".$data."');</script>");
        }
    }

    public function FindSubject_by_Name($Name){

            $sql = <<<EOF
select * from books where book_name LIKE "%$Name%";
EOF;
            $inner_res = $this->NowPDO->query($sql);
            $inner_res_array = $inner_res->fetchAll(PDO::FETCH_ASSOC);
            $Classes_object_List = array();
            foreach ($inner_res_array as $Now_class)
            {
                array_push($Classes_object_List,new Subject(
                    $Now_class["id"],
                    $Now_class["book_name"],
                    $Now_class["book_total"],
                    $Now_class["book_sell"]
                ));
            }
        return $Classes_object_List;
    }

    public function UpdateSubject($LastID,Subject $subject){
        $subjectID = $subject->getClassID();
        $subjectName = $subject->getClassName();
        $subjectTerm = $subject->getClassTerm();
        $subjectTime = $subject->getClassTime();
        $sql = <<<EOF
update books set 
book_name = "$subjectName",
book_total = $subjectTerm,
book_sell = $subjectTime,
where id = "$LastID";
EOF;
        echo $sql;
        $this->NowPDO->exec($sql);
    }

    public function FindIsBuy(Book $book){
        $bookName = $book->getBookName();
        $sql = <<<EOF
select book_total from books where book_name = "$bookName"
EOF;
        $inner_res = $this->NowPDO->query($sql);
        $res = $inner_res->fetchAll(PDO::FETCH_ASSOC);
        if (sizeof($res) == 0)
        {
            return -1;
        }
        $lastNum =  $res[0]["book_total"];
        $this->console_log($lastNum);
        return $lastNum;
    }

    public function AddOrder(Book $book){
        $nowUser =  $_SESSION['username'];
        $bookName = $book->getBookName();
        $sql = <<<EOF
SELECT id from books WHERE book_name = "$bookName"
EOF;
        $PDOStatement = $this->NowPDO->query($sql);
        $all = $PDOStatement->fetchAll(PDO::FETCH_ASSOC);
        $bookID = $all[0][id];

        $sql = <<<EOF
INSERT book_orders (user_id,book_id,time) VALUES("$nowUser","$bookID",NOW())
EOF;
        $this->NowPDO->exec($sql);

    }


    public function AddBook(Book $book){
        $bookName = $book->getBookName();
        $bookBuyNum = $book->getBookBuyNum();
        $LastNum =  $this->FindIsBuy($book);

        if ($LastNum == -1){
            $sql =<<<EOF
INSERT books (book_name,book_total,book_sell) VALUES("$bookName","$bookBuyNum","0")
EOF;
            $this->NowPDO->exec($sql);
            $this->AddOrder($book);
            return;
        }

        $nowNum = $LastNum+$bookBuyNum;
        $sql = <<<EOF
UPDATE books set book_total = $nowNum WHERE book_name = "$bookName"
EOF;
        $this->NowPDO->exec($sql);
        $this->AddOrder($book);
    }

    public function AddSubject(Subject $subject){
        $subjectName = $subject->getClassName();
        $subjectTerm = $subject->getClassTerm();
        $subjectTime = $subject->getClassTime();
        $sql = <<<EOF
insert into kcb 
values(
       '$subjectName',
       $subjectTerm,
       $subjectTime,
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

    public function SellBook($id,$num){
        $sql = <<<EOF
update books set 
book_total = book_total - $num,
book_sell = book_sell + $num
where id = $id;
EOF;
        $this->NowPDO->exec($sql);
    }
}