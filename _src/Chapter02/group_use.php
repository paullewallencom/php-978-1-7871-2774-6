<?php
// use statement in Pre-PHP7 code
use abc\namespace\ClassA;
use abc\namespace\ClassB;
use abc\namespace\ClassC as C;

use function abc\namespace\funcA;
use function abc\namespace\funcB;
use function abc\namespace\funcC;

use const abc\namespace\ConstA;
use const abc\namespace\ConstB;
use const abc\namespace\ConstC;

// PHP 7+ code
use abc\namespace\{ClassA, ClassB, ClassC as C};
use function abc\namespace\{funcA, funcB, funcC};
use const abc\namespace\{ConstA, ConstB, ConstC};
