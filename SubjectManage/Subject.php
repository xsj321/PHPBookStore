<?php


class Subject
{
    private $classID;
    private $className;
    private $classTerm;
    private $classTime;

    public function __construct($classID, $className, $classTerm, $classTime)
    {
        $this->classID = $classID;
        $this->className = $className;
        $this->classTerm = $classTerm;
        $this->classTime = $classTime;
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



}