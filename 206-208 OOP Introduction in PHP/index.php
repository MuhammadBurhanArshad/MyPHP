<?php 



class calculation {
    public $a, $b, $c;

    function sum() {
        return $this->c = $this->b + $this->a;
    }

    function sub() {
        return $this->c = $this->b - $this->a;
    }
}

$object1 = new calculation();

$object1->a = 10;
$object1->b = 20;

$object2 = new calculation();

$object2->a = 10;
$object2->b = 20;

echo $object1->sum();
echo "<br>";
echo $object2->sub();