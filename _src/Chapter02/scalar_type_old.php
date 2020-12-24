<?php

function add($num1, $num2){
	if (!is_int($num1)){
		throw new Exception("$num1 is not an integer");
	}
	if (!is_int($num2)){
		throw new Exception("$num2 is not an integer");
	}
	return ($num1+$num2);
}

echo add(2,4);   //6
echo add(1.5,4); //Fatal error:  Uncaught Exception: 1.5 is not an integer
