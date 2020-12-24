<?php
$records = [
    ["id" => 7, "name" => 'Haafiz'],
    ["id" => 8, "name" => 'Ali'],
];

// list() style
list("id" => $firstId, "name" => $firstName) = $records[0];

// [] style
["id" => $firstId, "name" => $firstName] = $records[0];
