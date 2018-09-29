<?php

/**
 * Created by PhpStorm.
 * User: joeychen
 * Date: 2018/9/18
 * Time: 下午 08:37
 */

namespace Tests;

use PHPUnit\Framework\TestCase;

class OrderServiceTest extends TestCase
{

    /** @test */
    public function test_sync_book_orders_3_orders_only_2_book_order()
    {
        // hard to isolate dependency to unit test
        $target = new OrderServiceForTest();

        $order1 = new Order();
        $order1->type = 'Book';

        $order2 = new Order();
        $order2->type = 'Book';

        $order3 = new Order();
        $order3->type = 'Book';

        $target->setOrders(
            $order1,
            $order2,
            $order3
        );

        $spyBook = m::spy(IBook::class);

        $target->setBook($spyBook);

        $target->syncBookOrders();

        $spyBook->shouldHaveReceive('insert')
            ->with(m::on(function ($order) {
                return $order->type == 'Book';
            }))->twice();
    }
}

class OrderServiceForTest extends \App\OrderService
{
    private $orders;
    private $book;

    protected function getBook()
    {
        return $this->book;
    }

    public function setBook(IBook $book)
    {
        $this->book = $book;
    }

    public function setOrders($orders)
    {
        $this->orders = $orders;
    }

    protected function getOrders()
    {
        return $this->orders;
    }
}
