<!--操作数据库的工具类-->
<?php


class User_DataBaseUtil
{

    private $NowPDO;
    private $dbms='mysql';     //数据库类型
    private $host='localhost'; //数据库主机名
    private $dbName='pxscj';    //使用的数据库
    private $user='root';      //数据库连接用户名
    private $pass='xsj08262334910';          //对应的密码
    /**
     * User_DataBaseUtil constructor.
     * 用来创建数据库操作工具类
     */
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

    /**
     * @param $username 插入的用户姓名
     * @param $passwd   插入的用户密码
     * 用来新建用户的数据，并插入到数据库
     */
    function DB_insert ($username, $passwd,$isteacher)
    {
        $sql = <<<EOF
        INSERT INTO account VALUES ("$username","$passwd",$isteacher);
EOF;
        $this->NowPDO->exec($sql);
    }

    /**
     * @param $username 查找的用户姓名
     * @return array|false  返回查找到的用户的信息
     * 用来查找用户注册的账号密码
     */
    function DB_read($username)
    {
        $sql = <<<EOF
        SELECT * from account WHERE ID = "$username";
EOF;
        $ret = $this->NowPDO->query($sql);
        $row = $ret->fetchAll(PDO::FETCH_ASSOC);
        print_r($row);
        return $row[0];
    }


}


