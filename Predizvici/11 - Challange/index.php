<?php

class Product {
    public $name;
    public $price;
    public $sellingByKg;

    public function __construct($name, $price, $sellingByKg) {
        $this->name = $name;
        $this->price = $price;
        $this->sellingByKg = $sellingByKg;
    }

    public function getPrice() {
        return $this->price;
    }
}

class MarketStall {
    public $products;

    public function __construct($products) {
        $this->products = $products;
    }

    public function addProductToMarket($name, Product $product) {
        $this->products[$name] = $product;
    }

    public function getItem($name, $amount) {
        if (isset($this->products[$name])) {
            return ['amount' => $amount, 'item' => $this->products[$name]];
        } else {
            return false;
        }
    }
}

class Cart {
    private $cartItems = [];

    public function addToCart($item) {
        $this->cartItems[] = $item;
    }

    public function printReceipt() {
        if (empty($this->cartItems)) {
            return "Your cart is empty<br>";
        }

        $totalAmount = 0;

        foreach ($this->cartItems as $cartItem) {
            $amount = $cartItem['amount'];
            $item = $cartItem['item'];

            $itemName = $item->name;
            $itemType = $item->sellingByKg ? 'kgs' : 'gunny sacks';
            $itemPrice = $item->getPrice();
            $total = $amount * $itemPrice;

            echo "$itemName | $amount $itemType | total= $total denars<br>";

            $totalAmount += $total;
        }

        echo "Final price amount: $totalAmount denars<br>";
    }
}

$orange = new Product('Orange', 35, true);
$potato = new Product('Potato', 240, false);
$nuts = new Product('Nuts', 850, true);
$kiwi = new Product('Kiwi', 670, false);
$pepper = new Product('Pepper', 330, true);
$raspberry = new Product('Raspberry', 555, false);

$marketStall1 = new MarketStall(['orange' => $orange, 'potato' => $potato, 'nuts' => $nuts]);
$marketStall2 = new MarketStall(['kiwi' => $kiwi, 'pepper' => $pepper, 'raspberry' => $raspberry]);

$cart = new Cart();
$cart->addToCart($marketStall1->getItem('orange', 3));
$cart->addToCart($marketStall2->getItem('raspberry', 2));
$cart->addToCart($marketStall1->getItem('pepper', 1));

$cart->printReceipt();

?>