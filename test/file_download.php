<?php

require_once("../src/utils.php");
require_once('../src/WcsFileDownloader.class.php');
require_once('config.inc.php');

function print_help() {
    echo "Usage: php file_download.php [-h | --help] -b bucketName -f fileKey\n";
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


$downloader = new WcsFileDownloader();

$url = $downloader->build_public_url($bucketName, $fileKey);
print("public url: \t$url\n");
$url = $downloader->build_private_url($bucketName, $fileKey);
print("private url: \t$url\n");

