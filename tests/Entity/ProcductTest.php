<?php

namespace App\Tests\Entity;

use App\Entity\Product;
use App\Service\Calculator;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ProcductTest extends KernelTestCase
{
    

    public function testProductEntity() {
        $product = new Product();

        $product->setName('produit1'); 
        $product->setPrice(15666); 

        $this->assertEquals('produit1',$product->getName());
        $this->assertEquals(15666, $product->getPrice()); 
    }

    public function getProducts()
    {
        return [
            [
                'product' => $this->createProduct("Ballon rouge", 10),
                'quantity' => 3
            ],
            [
                'product' => $this->createProduct("Ballon bleu", 8),
                'quantity' => 2
            ],
            [
                'product' => $this->createProduct("Ballon jaune", 11),
                'quantity' => 5
            ]
        ];
    }

    public function createProduct($name, $price)
    {
        return ((new Product())
        ->setName($name)
        ->setPrice($price));
    }    
    
}
