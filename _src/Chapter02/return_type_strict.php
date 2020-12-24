<?php
declare(strict_types=1);
function add($num1, $num2):int{
    return ($num1+$num2);
}

echo add(2,4); //6
echo add(2.5,4); //Fatal error:  Uncaught TypeError: Return value of add() must be of the type integer, float returned
