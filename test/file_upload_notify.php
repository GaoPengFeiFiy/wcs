<?php
require_once("../src/utils.php");
require_once('config.inc.php');
require_once('../src/WcsFileUploader.class.php');

function print_help() {
    echo "Usage: php file_upload_notify.php [-h | --help] -b bucketName -f fileKey -l localFile -n notifyUrl -c cmd\n";
}
$opts = "hb:f:l:c:n:";
$longopts = array (
    'h',
    'help'
);

$options = getopt($opts, $longopts);
if (isset($options['h']) || isset($options['help'])) {
    print_help();
    exit(0);
}

if (!isset($options['b']) || !isset($options['f']) || !isset($options['l']) || !isset($options['c']) || !isset($options['n'])) {
    print_help();
    exit(0);
}

$bucketName = $options['b'];
$fileKey = $options['f'];
$localFile = $options['l'];
$notifyUrl = $options['n'];
$cmd = $options['c'];

print("bucket: \t$bucketName\n");
print("file: \t\t$fileKey\n");
print("localFile: \t$localFile\n");
print("notifyUrl: \t$notifyUrl\n");
print("operation: \t$cmd\n");
print("\n");


$client = new WcsFileUploader();
print_r($client->upload_notify($bucketName, $fileKey, $localFile, $cmd, $notifyUrl));
print("\n");
