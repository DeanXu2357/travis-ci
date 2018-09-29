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

        if ($this->isXmas($date)) {
            return "Merry Xmas";
        }

        return "Today is not Xmas";
    }

    /**
     * 是否為聖誕節
     *
     * @param string $date
     * @return boolean
     */
    private function isXmas(string $date)
    {
        return $date == '12-25';
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
