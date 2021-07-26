<?php

namespace App\Entity;

use App\Entity\Product;

class Cart
{
    /**
     * @var Array
     */
    private $items;

    public function __construct()
    {
        $this->items = [];
    }

    public function getItems(): Array
    {
        return $this->items;
    }

    public function addItem(CartItem $item): self
    {
        foreach ($this->getItems() as $existingItem) {

            if ($existingItem->equals($item)) {
                $existingItem->setQuantity(
                    $existingItem->getQuantity() + $item->getQuantity()
                );
                return $this;
            }
        }

        $this->items[] = $item;
        
        return $this;
    }

    public function removeItem(CartItem $item): self
    {
        foreach($this->getItems() as $index => $_item){
            
            if($item==$_item){
                
                \array_splice($this->items, $index, 1);
            }
        }

        return $this;
    }

    public function removeItemByUrl(string $url): self
    {
        $items=$this->getItems();

        foreach($items as $item){
            
            if($item->getProduct()->getUrl()==$url){
                
                $this->removeItem($item);
                
                break;
            }
        }

        return $this;
    }

    /**
     * Removes all items from the cart.
     */
    public function removeItems(): self
    {
        foreach ($this->getItems() as $item) {
            
            $this->removeItem($item);
        }

        return $this;
    }

    /**
     * Calculates the order total.
     */
    public function getTotal(): float
    {
        $total = 0.00;

        foreach ($this->getItems() as $item) {
            
            $total += $item->getTotal();
        }

        return $total;
    }

    public function getTotalVat(){

        $totalVat = 0.00;

        foreach ($this->getItems() as $item) {
            
            $totalVat += $item->getTotal()*$item->getProduct()->getVat();
        }

        return $totalVat;
    }

    public function changeQuantity(string $url, $quantity){
        
        $items=$this->getItems();

        foreach($items as $item){
            
            if($item->getProduct()->getUrl()==$url){
                $item->setQuantity($quantity);
                break;
            }
        }
    }
}
