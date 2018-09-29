<?php

namespace App;

// use Carbon;

class Holiday
{
    private $date;

    public function __construct($date = '')
    {
        if ($date == '') {
            $date = date('m-d');
        }

        $this->date = $date;
    }

    public function SayXmas() : string
    {
        $date = $this->getToday();

        if ($date == '12-25') {
            return "Merry Xmas";
        }

        return "Today is not Xmas";
    }

    protected function getToday()
    {
        return date('m-d');
    }

    protected function setToday()
    {
        $this->date = date('m-d');
    }

}
