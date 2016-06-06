<?php

require_once("../src/utils.php");
require_once("../src/WcsImageManager.class.php");
require_once('../src/WcsImageView.class.php');
require_once('config.inc.php');

function print_help() {
    echo "Usage: php image_view.php [-h | --help] -b bucketName -f fileKey --mode 1|2|3 [--width int] [--height int] [--quality int(1-100)] [--format jpg|gif|png]\n";
}
$opts = "hb:f:";
$longopts = array (
    'h',
    'help',
    'mode:',
    'width:',
    'height:',
    'quality:',
    'format:'
);

$options = getopt($opts, $longopts);
if (isset($options['h']) || isset($options['help'])) {
    print_help();
    exit(0);
}

if (!isset($options['b']) || !isset($options['f']) || !isset($options['mode'])) {
    print_help();
    exit(0);
}

$bucketName = $options['b'];
$fileKey = $options['f'];
$imageView = new WcsImageView($options['mode']);
if (isset($options['width'])) {
    $imageView->width = $options['width'];
}
if (isset($options['height'])) {
    $imageView->height = $options['height'];
}
if (isset($options['quality'])) {
    $imageView->quality = $options['quality'];
}
if (isset($options['format'])) {
    $imageView->format = $options['format'];
}

print("bucket: \t$bucketName\n");
print("file: \t\t$fileKey\n");
print("imageView: \t" . json_encode($imageView) . "\n");
print("\n");


$client = new WcsImageManager();
$url = $client->build_view_public_url($bucketName, $fileKey, $imageView);
print("public url: \t$url\n");
$url = $client->build_view_private_url($bucketName, $fileKey, $imageView);
print("private url: \t$url\n");
