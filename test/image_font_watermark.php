<?php

require_once("../src/utils.php");
require_once("../src/WcsImageManager.class.php");
require_once('../src/WcsImageWatermark.class.php');
require_once('config.inc.php');

function print_help() {
    echo "Usage: php image_font_watermark.php [-h | --help] -b bucketName -f fileKey --text string [--font string] [--fontsize int] [--fill color] [--dissolve int(1-100)] [--gravity POS] [--dx int] [--dy int]\n";
}
$opts = "hb:f:";
$longopts = array (
    'h',
    'help',
    'text:',
    'font:',
    'fontsize:',
    'fill:',
    'dissolve:',
    'gravity:',
    'dx:',
    'dy:'
);

$options = getopt($opts, $longopts);
if (isset($options['h']) || isset($options['help'])) {
    print_help();
    exit(0);
}

if (!isset($options['b']) || !isset($options['f']) || !isset($options['text'])) {
    print_help();
    exit(0);
}

$bucketName = $options['b'];
$fileKey = $options['f'];
$watermark = new WcsImageWatermark(2);
$watermark->text = $options['text'];
if (isset($options['font'])) {
    $watermark->font = $options['font'];
}
if (isset($options['fontsize'])) {
    $watermark->fontsize = $options['fontsize'];
}
if (isset($options['fill'])) {
    $watermark->fill = $options['fill'];
}
if (isset($options['dissolve'])) {
    $watermark->dissolve = $options['dissolve'];
}
if (isset($options['gravity'])) {
    $watermark->gravity = $options['gravity'];
}
if (isset($options['dx'])) {
    $watermark->dx = $options['dx'];
}
if (isset($options['dy'])) {
    $watermark->dy = $options['dy'];
}
print("bucket: \t$bucketName\n");
print("file: \t\t$fileKey\n");
print("watermark: \t" . json_encode($watermark) . "\n");
print("\n");


$client = new WcsImageManager();
$url = $client->build_watermark_public_url($bucketName, $fileKey, $watermark);
print("public url: \t$url\n");
$url = $client->build_watermark_private_url($bucketName, $fileKey, $watermark);
print("private url: \t$url\n");
