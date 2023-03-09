<?php

// Define the container class
class Container {
    private $width;
    private $length;
    
    public function __construct($width, $length) {
        $this->width = $width;
        $this->length = $length;
    }
    
    public function getWidth() {
        return $this->width;
    }
    
    public function getLength() {
        return $this->length;
    }
    
    public function getArea() {
        return $this->width * $this->length;
    }
}

// Define the commodity classes is the objects 
abstract class Commodity {
    abstract public function getArea();
}

class Square extends Commodity {
    private $width;
    private $length;
    
    public function __construct($width, $length) {
        $this->width = $width;
        $this->length = $length;
    }
    
    public function getWidth() {
        return $this->width;
    }
    
    public function getLength() {
        return $this->length;
    }
    
    public function getArea() {
        return $this->width * $this->length;
    }
}

class Circle extends Commodity {
    private $radius;
    
    public function __construct($radius) {
        $this->radius = $radius;
    }
    
    public function getRadius() {
        return $this->radius;
    }
    
    public function getArea() {
        return $this->radius * 2;
    }
}

// Define the calculation class
class Calculation {
    private $bigContainer;
    private $smallContainer;
    
    public function __construct() {
        $this->bigContainer = new Container(300, 200);
        $this->smallContainer = new Container(100, 100);
    }
    
    public function calculateContainers($commodities) {
        $totalArea = 0;
        foreach ($commodities as $commodity) {
            $totalArea += $commodity->getArea();
        }
        
        $bigContainerCount = ceil($totalArea / $this->bigContainer->getArea());
        $smallContainerCount = ceil(($totalArea - $bigContainerCount * $this->bigContainer->getArea()) / $this->smallContainer->getArea());
        
        return array($bigContainerCount, $smallContainerCount);
    }
}

// Define the transports
$transport1 = array(new Circle(50), new Circle(50), new Square(100, 100));
$transport2 = array(new Square(400, 400), new Circle(100));
$transport3 = array(new Square(150, 100), new Square(50, 50), new Circle(50));

// Calculate the containers needed for each transport
$calculation = new Calculation();
$transport1Containers = $calculation->calculateContainers($transport1);
$transport2Containers = $calculation->calculateContainers($transport2);
$transport3Containers = $calculation->calculateContainers($transport3);

// Print the results
echo "Transport 1:\n";
echo "Big containers needed: " . $transport1Containers[0] . "\n";
echo "Small containers needed: " . $transport1Containers[1] . "\n\n";

echo "Transport 2:\n";
echo "Big containers needed: " . $transport2Containers[0] . "\n";
echo "Small containers needed: " . $transport2Containers[1] . "\n\n";

echo "Transport 3:\n";
echo "Big containers needed: " . $transport3Containers[0] . "\n";
echo "Small containers needed: " .  $transport3Containers[1]. "\n";
