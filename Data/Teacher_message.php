<?php


class Teacher_message
{
    private $teacherID;
    private $teacherName;
    private $isAdmin;
    private $other;

    public function __construct($teacherID, $teacherName, $isAdmin, $other)
    {
        $this->teacherID = $teacherID;
        $this->teacherName = $teacherName;
        $this->isAdmin = $isAdmin;
        $this->other = $other;
    }

    /**
     * @return mixed
     */
    public function getTeacherID()
    {
        return $this->teacherID;
    }

    /**
     * @return mixed
     */
    public function getTeacherName()
    {
        return $this->teacherName;
    }

    /**
     * @return mixed
     */
    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * @return mixed
     */
    public function getOther()
    {
        return $this->other;
    }

}