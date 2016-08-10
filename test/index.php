<?php
/**
 * Created by PhpStorm.
 * User: lv
 * Date: 16/6/3
 * Time: 下午1:31
 */


include_once '../vendor/autoload.php';

print_r(\Outyua\Wcs\WcsFile::getPublicDownloadUrl('hotcast-test001', '111.mp4'));