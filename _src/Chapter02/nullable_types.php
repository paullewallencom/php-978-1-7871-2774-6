<?php

function testReturn(): ?string
{
    return 'testing';
}

var_dump(testReturn());
// string(10) "testing"

function testReturn2(): ?string
{
    return null;
}

var_dump(testReturn2());
//NULL

function test(?string $name)
{
    var_dump($name);
}

test('testing');
//string(10) "testing"

test(null);
//NULL

test();
// Fatal error:  Uncaught ArgumentCountError: Too few arguments to function test(),
