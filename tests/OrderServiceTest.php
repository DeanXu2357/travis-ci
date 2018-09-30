<?php

/**
 * Created by PhpStorm.
 * User: joeychen
 * Date: 2018/9/18
 * Time: 下午 08:37
 */

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Order;

class OrderServiceTest extends TestCase
{
    private $target;

    protected function setup()
    {
        $this->target = new OrderServiceForTets();
    }

    /** @test */
    public function test_sync_book_orders_3_orders_only_2_book_order()
    {
        $this->givenOrders(['Book', 'CD', 'Book']);

        $spyBook = m::spy(IBook::class);

        $target->setBook($spyBook);

        $this->target->syncBookOrders();

        $spyBook->shouldHaveReceive('insert')
            ->with(m::on(function ($order) {
                return $order->type == 'Book';
            }))->twice();
    }

    protected function givenOrders($type)
    {
        $orders = [];
        foreach ($type as $key => $value) {
            $orders[] = $this->orderCreater($value);
        }

        $this->target->setOrders($orders);
    }

    protected function orderCreater($createType)
    {
        $order = new Order();
        $order->type = $createType;

        return $order;
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
