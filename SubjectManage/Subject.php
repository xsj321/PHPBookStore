<?php


class Subject
{
    private $classID;
    private $className;
    private $classTerm;
    private $classTime;
    private $classMark;

    public function __construct($classID, $className, $classTerm, $classTime, $classMark)
    {
        $this->classID = $classID;
        $this->className = $className;
        $this->classTerm = $classTerm;
        $this->classTime = $classTime;
        $this->classMark = $classMark;
    }

    /**
     * @return mixed
     */
    public function getClassID()
    {
        return $this->classID;
    }

    /**
     * @return mixed
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * @return mixed
     */
    public function getClassTerm()
    {
        return $this->classTerm;
    }

    /**
     * @return mixed
     */
    public function getClassTime()
    {
        return $this->classTime;
    }

    /**
     * @return mixed
     */
    public function getClassMark()
    {
        return $this->classMark;
    }


}