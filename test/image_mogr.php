<?php

require_once("../src/utils.php");
require_once("../src/WcsImageManager.class.php");
require_once('../src/WcsImageMogr.class.php');
require_once('config.inc.php');

function print_help() {
    echo "Usage: php image_mogr.php [-h | --help] -b bucketName -f fileKey [--auto-orient] [--thumbnail string] [--gravity string] [--crop string] [--quality int(1-100)] [--rotate int(1-360)] [--format jpg|gif|png]\n";
}
$opts = "hb:f:";
$longopts = array (
    'h',
    'help',
    'auto-orient',
    'thumbnail:',
    'gravity:',
    'crop:',
    'quality:',
    'rotate:',
    'format:'
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
$imageMogr = new WcsImageMogr();
if (isset($options['auto-orient'])) {
    $imageMogr->autoOrient = true;
}
if (isset($options['thumbnail'])) {
    $imageMogr->thumbnail = $options['thumbnail'];
}
if (isset($options['gravity'])) {
    $imageMogr->gravity =  $options['gravity'];
}
if (isset($options['crop'])) {
    $imageMogr->crop = $options['crop'];
}
if (isset($options['quality'])) {
    $imageMogr->quality = $options['quality'];
}
if (isset($options['rotate'])) {
    $imageMogr->rotate = $options['rotate'];
}
if (isset($options['format'])) {
    $imageMogr->format = $options['format'];
}
print("bucket: \t$bucketName\n");
print("file: \t\t$fileKey\n");
print("imageMogr: \t" . json_encode($imageMogr) . "\n");
print("\n");


$client = new WcsImageManager();
$url = $client->build_mogr_public_url($bucketName, $fileKey, $imageMogr);
print("public url: \t$url\n");
$url = $client->build_mogr_private_url($bucketName, $fileKey, $imageMogr);
print("private url: \t$url\n");
