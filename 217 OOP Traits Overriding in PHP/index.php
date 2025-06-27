<?php 

trait hello {
    public function hello() {
        echo "Hello from Trait.";
    }
}

trait hi {
    public function hello() {
        echo "Hello again from new Trait.";
    }
}

class Base {
    public function hello() {
        echo "Hello from Base Class.";
    }
}

class Child extends Base {
    use hello; // we can also call multiple traits comma separated in in same class, but the same name function is not allowed when calling both traits in same class, for conflict resolve we work as:

    use hello, hi {
        hello::hello insteadof hi; // can define one function to run at while conflict
        hi::hello as hiHello; // can also rename function to use both with different names in same class
        hello::hello as public; // can also change the access modifiers of function
        hello::hello as public newHello; // can use for change the access modifier and name both at once
    }

    public function hello() {
        echo "Hello from Child Class";
    }
}

$child = new Child();

$child->hello(); // more priority will be to child's hello function