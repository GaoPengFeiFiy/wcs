<?php

require_once("../src/utils.php");
require_once("../src/WcsImageManager.class.php");
require_once('config.inc.php');

function print_help() {
    echo "Usage: php image_exif.php [-h | --help] -b bucketName -f fileKey\n";
}
$opts = "hb:f:";
$longopts = array (
    'h',
    'help'
);

$options = getopt($opts, $longopts);
if (isset($options['h']) || isset($options['help'])) {
    print_help();
    exit(0);
}

if (!isset($options['b']) || !isset($options['f'])) {
    print_help();
    exit(0);
}

$bucketName = $options['b'];
$fileKey = $options['f'];

print("bucket: \t$bucketName\n");
print("file: \t\t$fileKey\n");
print("\n");


$client = new WcsImageManager();
$info = $client->exif_public($bucketName, $fileKey);
print("public: \t$info\n");
$info = $client->exif_private($bucketName, $fileKey);
print("private: \t$info\n");
