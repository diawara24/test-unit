<?php

namespace App\Tests\Entity;

use App\Entity\Order;
use App\Entity\Product;
use App\Entity\User;
use App\Service\Calculator;

use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class OrderTest extends KernelTestCase
{
    public function testOrderEntity() {
        $order = new Order();
        $user = new User();
        $user->setFirstName("Test");
        $order->setNumber(11111);
        $order->setTotalPrice(12000);
        $order->setUser($user);

        $this->assertEquals(12000, $order->getTotalPrice());
        $this->assertEquals("Test", $order->getUser()->getFirstName());
    }

    public $items;

    public function createProduct($name, $price)
    {
        return ((new Product())
        ->setName($name)
        ->setPrice($price));
    }   
    
    protected function setUp(): void{
        $this->items =  [
            [
                'product' => $this->createProduct("Produit 1", 10),
                'quantity' => 1
            ],
            [
                'product' => $this->createProduct("Produit 2", 8),
                'quantity' => 2
            ],
            [
                'product' => $this->createProduct("Produit 3", 11),
                'quantity' => 5
            ]
        ];
    }


    public function testGetTotalHT() {
        $calculator = new Calculator();
        $this->assertEquals(81, $calculator->getTotalHT($this->items));
    }

    public function testGetTotalTTC() {
        $calculator = new Calculator();
        $this->assertEquals(89.1, $calculator->getTotalTTC($this->items, 10));
    }

  
}
