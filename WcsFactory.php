<?php
/**
 * Created by PhpStorm.
 * User: lv
 * Date: 16/7/21
 * Time: 下午3:50
 */
namespace Outyua\Wcs;

class WcsFactory {
    private static $_WcsFileManager = null;
    private static $_WcsFileDownloader = null;
    private static $_WcsFileUploader = null;
    public static function getWcsFileManager() {
        if(null === self::$_WcsFileManager) {
            self::$_WcsFileManager = new \WcsFileManager();
        }
        return self::$_WcsFileManager;
    }
    public static function getWcsFileDownloader() {
        if(null === self::$_WcsFileDownloader) {
            self::$_WcsFileDownloader = new \WcsFileDownloader();
        }
        return self::$_WcsFileDownloader;
    }
    public static function getWcsFileUploader() {
        if(null === self::$_WcsFileUploader) {
            self::$_WcsFileUploader = new \WcsFileUploader();
        }
        return self::$_WcsFileUploader;
    }
}