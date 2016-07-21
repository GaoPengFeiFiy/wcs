<?php
/**
 * Created by PhpStorm.
 * User: lv
 * Date: 16/6/3
 * Time: 上午11:51
 */

namespace Outyua\Wcs;

class WcsFile {

    /**
     * @param string $bucket          文件空间
     * @param string $key             文件key
     * @return bool|mixed   获取返回数组,如果失败,返回false
     */

    public static function getFileInfo($bucket, $key) {
        $wcs = WcsFactory::getWcsFileManager();
        return self::_output($wcs->stat($bucket, $key));
    }

    /**
     * @param string $bucket   空间名
     * @param string $key      文件key
     * @return bool     是否删除成功
     */
    public static function deleteFile($bucket, $key) {
        $wcs = WcsFactory::getWcsFileManager();
        return self::_output($wcs->delete($bucket, $key));
    }


    /**
     * @param string $bucket    文件空间
     * @param string $key       文件key
     * @return bool|mixed       返回数组,失败返回false
     */

    public static function getPublicDownloadUrl($bucket, $key) {
        $wcs = WcsFactory::getWcsFileDownloader();
        return $wcs->build_public_url($bucket, $key);
    }

    /**
     * @param string $bucket    文件空间
     * @param string $key       文件key
     * @return bool|mixed       返回数组,失败返回false
     */

    public static function getPrivateDownloadUrl( $bucket,  $key) {
        $wcs = WcsFactory::getWcsFileDownloader();
        return $wcs->build_private_url($bucket, $key);
    }
    private static function _output($json) {
        $res = json_decode($json, true);
        if($res['code'] == 200) {
            unset($res['code']);
            unset($res['message']);
            if(empty($res)) {
                return true;
            } else {
                return $res;
            }
        } else {
            return false;
        }
    }

}