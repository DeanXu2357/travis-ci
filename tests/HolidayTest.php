<?php

namespace Tests;

use App\Holiday;
use PHPUnit\Framework\TestCase;

/**
 * @covers \App\HelloWord
 */
class HolidayTest extends TestCase
{
    /**
     * @covers \App\HelloWord::say()
     */
    public function testSayXmas()
    {
        $case = [
            [
                'excepted'  => 'Merry Xmas',
                'date'      => '12-25'
            ],
            [
                'excepted'  => 'Today is not Xmas',
                'date'      => date('1-9')
            ]
        ];

        // arrange
        $target = new Holiday();

        foreach ($case as $value) {
            $excepted = $value['excepted'];

            # act
            $target->setDate($value['date']);
            $actual = $target->SayXmas();

            # assert
            $this->assertEquals($excepted, $actual);
        }

        // act
        // $actual = $target->SayXmas();

        // assert
        // $this->assertEquals($excepted, $actual);
    }
}

// # Stub Example
// class HolidayForTest extends Holiday
// {
//     protected function getToday()
//     {
//         return $this->date('m-d');
//     }

//     public function setToday($date)
//     {
//         $this->date = $date;
//     }
// }