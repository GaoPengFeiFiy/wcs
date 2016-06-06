<?php
require_once("../src/utils.php");
require_once('config.inc.php');
require_once('../src/WcsFileUploader.class.php');

function print_help() {
    echo "Usage: php file_upload_callback.php [-h | --help] -b bucketName -f fileKey -l localFile -c callbackUrl -r returnBody\n";
}
$opts = "hb:f:l:r:c:";
$longopts = array (
    'h',
    'help'
);

$options = getopt($opts, $longopts);
if (isset($options['h']) || isset($options['help'])) {
    print_help();
    exit(0);
}

if (!isset($options['b']) || !isset($options['f']) || !isset($options['l']) || !isset($options['r']) || !isset($options['c'])) {
    print_help();
    exit(0);
}

$bucketName = $options['b'];
$fileKey = $options['f'];
$localFile = $options['l'];
$callbackUrl = $options['c'];
$returnBody = $options['r'];

print("bucket: \t$bucketName\n");
print("file: \t\t$fileKey\n");
print("localFile: \t$localFile\n");
print("callbackUrl: \t$callbackUrl\n");
print("returnBody: \t$returnBody\n");
print("\n");


$client = new WcsFileUploader();
print_r($client->upload_callback($bucketName, $fileKey, $localFile, $callbackUrl, $returnBody));
print("\n");
