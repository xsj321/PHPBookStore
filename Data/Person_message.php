<?php
require_once "Student_DatabaseUtil.php";

class Person_message
{
    private $name;
    private $ID;
    private $sex;
    private $berth;
    private $profession;
    private $mark;
    private $other;
    private $classes;
    public function __construct($name, $ID, $sex, $berth, $profession, $mark, $other, $classes = null)
    {
        $this->name = $name;
        $this->ID = $ID;
        $this->sex = $sex;
        $this->berth = $berth;
        $this->profession = $profession;
        $this->mark = $mark;
        $this->other = $other;
        $this->classes = $classes;
    }


    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getID()
    {
        return $this->ID;
    }

    /**
     * @return mixed
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * @return mixed
     */
    public function getBerth()
    {
        return $this->berth;
    }

    /**
     * @return mixed
     */
    public function getProfession()
    {
        return $this->profession;
    }

    /**
     * @return mixed
     */
    public function getMark()
    {
        return $this->mark;
    }

    /**
     * @return mixed
     */
    public function getOther()
    {
        return $this->other;
    }

    /**
     * @return mixed
     */
    public function getClasses()
    {
        return $this->classes;
    }

}