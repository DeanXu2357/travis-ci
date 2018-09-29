<?php

namespace Tests;

use App\Holiday;
use PHPUnit\Framework\TestCase;

/**
 * @covers \App\HelloWord
 */
class HolidayTest extends TestCase
{
    private $target;
    // private $actual;

    protected function setUp()
    {
        parent::setUp();
        $this->target = new HolidayForTest();
    }

    /**
     * @covers \App\HelloWord->SayXmas()
     */
    public function testSayXmas()
    {
        $case = [
            [
                'excepted'  => 'Merry Xmas',
                'date'      => '12-25',
                'des'       => 'test today is Xmas'
            ],
            [
                'excepted'  => 'Today is not Xmas',
                'date'      => '1-9',
                'des'       => 'test today is not Xmas'
            ]
        ];

        echo PHP_EOL;

        foreach ($case as $index => $value) {
            echo 'Case_' . (string)((integer)$index + 1) . PHP_EOL;
            echo json_encode($value, JSON_UNESCAPED_UNICODE) . PHP_EOL;

            $this->givenToday($value['date']);
            $this->shouldResponse($value['excepted']);

            echo 'description:' . $value['des'] . PHP_EOL;
            echo PHP_EOL;
        }
    }

    private function givenToday($date)
    {
        $this->target->setToday($date);
    }

    private function shouldResponse($excepted)
    {
        $actual = $this->target->SayXmas();
        $this->assertEquals($excepted, $actual);
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