<?php
function add(int $num1,int $num2){
    return ($num1+$num2);
}

echo add(2,4); //6
echo add("2",4); //6
echo add("something",4); // Fatal error:  Uncaught TypeError: Argument 1 passed to add() must be of the type integer, string given
