<?php

// will be used in a shell to load the file and convert it

include_once __DIR__ . '/../vendor/autoload.php';

// take cli arguments

$options = [
	'f:',   // file path to the variables.less file
	't:'    // type of conversion, default is less
];

$options = getopt(implode('', $options));

if (empty($options) || empty($options['t']) || empty($options['f']) || is_array($options['t']) || is_array($options['f']))
{
	die('Error on arguments. It should be -f path to file -t type of conversion');
}

$filePath = $options['f'];
$type = $options['t'];

if (!file_exists($filePath) || !is_readable($filePath) || !is_file($filePath))
{
	die ('Error, the file doesn\'t exist or is not accessible.');
}

if ('less' != $type)
{
	die ('Only less type are supported right now');
}

// load the file, yeah I know this can be insecure!
// $data = new ArrayIterator(file($filePath));
$data = file_get_contents($filePath);

$convertor = new \Grummfy\BVC\Less\Convert();
// convert the file and print the result
$convertor->convert($data, function($rows)
{
	echo json_encode($rows);
});
