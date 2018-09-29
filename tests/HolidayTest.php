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

        echo PHP_EOL;

        foreach ($case as $index => $value) {
            echo 'Case_' . (string)((integer)$index + 1) . PHP_EOL;
            echo json_encode($value, JSON_UNESCAPED_UNICODE) . PHP_EOL;

            // arrange
            $target = new HolidayForTest();
            $excepted = $value['excepted'];

            # act
            $target->setToday($value['date']);
            $actual = $target->SayXmas();
            echo 'Actual = ' . (string)$actual . PHP_EOL;
            echo PHP_EOL;

            # assert
            $this->assertEquals($excepted, $actual);
        }
    }
}

# Stub Example
# Extract And Override
# 不適用 static or finall( php 沒有 )
class HolidayForTest extends Holiday
{
    protected function getToday()
    {
        return $this->date;
    }

    public function setToday($date)
    {
        $this->date = $date;
    }
}