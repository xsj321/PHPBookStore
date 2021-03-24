<?php


class Book
{
    private $ID;
    private $BookName;
    private $BookBuyNum;
    private $BookSell;

    /**
     * Book constructor.
     * @param $BookName
     * @param $BookBuyNum
     */
    public function __construct($BookName, $BookBuyNum)
    {
        $this->BookName = $BookName;
        $this->BookBuyNum = $BookBuyNum;
    }

    /**
     * @return mixed
     */
    public function getBookName()
    {
        return $this->BookName;
    }

    /**
     * @param mixed $BookName
     */
    public function setBookName($BookName)
    {
        $this->BookName = $BookName;
    }

    /**
     * @return mixed
     */
    public function getBookBuyNum()
    {
        return $this->BookBuyNum;
    }

    /**
     * @param mixed $BookBuyNum
     */
    public function setBookBuyNum($BookBuyNum)
    {
        $this->BookBuyNum = $BookBuyNum;
    }


}