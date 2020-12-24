<?php
$records = [
    [7, 'Haafiz'],
    [8, 'Ali'],
];

// list() style
list($firstId, $firstName) = $records[0];

// [] in PHP7.1 is having same result
[$firstId, $firstName] = $records[0];
