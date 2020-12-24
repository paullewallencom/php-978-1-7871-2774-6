<?php
//  PHP 7+ code
class Point{
    private $x = 1; 
    private $y = 2;
}

// PHP 7+ code
$getX = function() {return $this->x;};
echo $getX->call(new Point); // outputs 1 as doing same thing 
