<?php

$data =
    <<<'EOD'

		X, -9\\\10\100\-5\\\0\\\\, A

		Y, \\13\\1\, B

		Z, \\\5\\\-3\\2\\\800, C

	EOD;

#split by line
$string = explode("\n", $data);

function clearArray($var)
{
    $filter = strpos($var, ",");
    if ($filter) {
        return true;
    }
    return false;
}

$arrayString = array_values(array_filter($string, "clearArray"));

function clearSlash($slash)
{
    if ($slash == "" || $slash == " ") {
        return false;
    }
    return true;
}
$allObj = array();


#split by comma and slash
foreach ($arrayString as $key => $strings) {
    $splitString = explode(",", $strings);

    $splitSlash = explode("\\", $splitString[1]);

    $numbers = array_values(array_filter($splitSlash, "clearSlash"));

    foreach ($numbers as $keyNumber => $number) {
        $new['first'] = preg_replace("/\s+/", "", $splitString[0]);
        $new['number'] = (int)$number;
        $new['third'] = preg_replace("/\s+/", "", $splitString[2]);

        array_push($allObj, $new);
    }
}

function cmp($a, $b)
{
    if ($a['number'] < $b['number']) {
        return -1;
    } else if ($a['number'] == $b['number']) {
        return 0;
    } else {
        return 1;
    }
}

usort($allObj, "cmp");

$counter = array(
    "X" => 1,
    "Y" => 1,
    "Z" => 1
);

foreach ($allObj as $keyObjt => $value) {
    print_r($value['first']);
    echo ", ";
    print_r($value['number']);
    echo ", ";
    print_r($value['third']);
    echo ", ";
    print_r($counter[$value['first']]);
    $counter[$value['first']] =  $counter[$value['first']] + 1;
    echo "<br>";
    echo "<br>";
}