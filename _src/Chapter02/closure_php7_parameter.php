<?php
// PHP 7+ closure call with parameter and binding

class Point{
 private $x = 1; 
 private $y = 2;
}

$getX = function($margin) {return $this->x + $margin;};
echo $getX->call(new Point, 2); //outputs 3 by ($margin + $this->x)
