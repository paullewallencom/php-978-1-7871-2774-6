<?php
function gen()
{
    yield "yield 1 from gen1";
    yield "yield 2 from gen1";
    yield from gen2();
}

function gen2()
{
    yield "yield 1 from gen2";
    yield "yield 2 from gen2";
}

foreach (gen() as $val)
{
    echo $val, PHP_EOL;
}


/* above will result in output:
yield 1 from gen1
yield 2 from gen1
yield 1 from gen2
yield 2 from gen2 
*/

