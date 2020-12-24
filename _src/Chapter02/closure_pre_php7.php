<?php
// Pre PHP 7 code
class Point{
    private $x = 1; 
    private $y=2;
}

$getXFn = function() {return $this->x;};
$getX = $getXFn->bindTo(new Point, 'Point');//intermediate closure
echo $getX(); // will output 1
