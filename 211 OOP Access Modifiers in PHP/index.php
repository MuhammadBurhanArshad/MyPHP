<?php 

class Base {
    public $name;

    public function __construct($name = "Base Class") {
        $this->name = $name;
    }

    public function showPublic() {
        return $this->name;
    }

    protected function showProtected() {
        return $this->name;
    }
    
    private function showPrivate() {
        return $this->name;
    }
}

class Derived extends Base {
    public function showDerived() {
        return $this->showProtected();
    }
}

$base = new Base("Base Class");

echo $base->showPublic(); // Output: Base Class
echo "<br>";
//echo $base->showProtected(); // Fatal error: Uncaught Error: Call to protected method Base::showProtected() from global scope
echo "<br>";
//echo $base->showPrivate(); // Fatal error: Uncaught Error: Call to private method Base::showPrivate() from global scope


$derived = new Derived("Derived Class");
echo $derived->showPublic(); // Output: Derived Class
echo "<br>";
// echo $derived->showProtected(); // Fatal error: Uncaught Error: Call to protected method Base::showProtected() from global scope
echo $derived->showDerived(); // Output: Derived Class
// echo $derived->showPrivate(); // Fatal error: Uncaught Error: Call to private method Base::showPrivate() from global scope
echo "<br>";


