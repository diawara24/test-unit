<?php
namespace App\Service;

use App\Entity\Order;

class Calculator {

    public function getTotalHT($items) {
        $totalHT  = 0;

        foreach ($items as $item) {
            $totalHT += ($item["product"]->getPrice() * $item["quantity"]);
        }

        return $totalHT;
    }

    public function getTotalTTC($items, $tva) {
        $totalHT  = $this->getTotalHT($items);
        return $totalHT + (($totalHT*$tva)/100);
    }
}