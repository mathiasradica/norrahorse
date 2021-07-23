<?php

namespace App\Entity;

class Cart
{
    /**
     * @var Array
     */
    private $items;

    /**
     * @var float
     */
    private $total;

    public function __construct()
    {
        $this->items = [];
        $this->total=0;
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
        $this->total+=$item->getTotal();
        
        return $this;
    }

    public function removeItem(CartItem $item): self
    {
        foreach($this->getItems() as $index => $_item){
            if($item==$_item){
                \array_splice($this->items, $index, 1);
                $this->total-=$item->getTotal();
            }
        }

        return $this;
    }

    public function removeItemByUrl(string $url): self
    {
        $product=$this->getDoctrine()->getRepository(Product::class)->findOneBy(['url'=>$url]);
        $items=$this->getItems();

        foreach($items as $item){
            if($item->getProduct()==$product){
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

    public function increaseQuantity(string $url){
        $items=$this->getItems();
        $product=$this->getDoctrine()->getRepository(Product::class)->findOneBy(['url'=>$url]);

        foreach($items as $item){
            if($item->getProduct()==$product){
                $item->setQuantity($item->getQuantity+1);
                break;
            }
        }
    }

    public function decreaseQuantity(string $url){
        $items=$this->getItems();
        $product=$this->getDoctrine()->getRepository(Product::class)->findOneBy(['url'=>$url]);

        foreach($items as $item){
            if($item->getProduct()==$product){
                $item->setQuantity($item->getQuantity-1);
                break;
            }
        }
    }
}
