<?php

require_once("utils.php");
require_once("config.inc.php");


class WcsFileManager
{

    /**
     * 删除文件
     * @param $bucketName
     * @param $fileKey
     * @return mixed
     */
    public function delete($bucketName, $fileKey)
    {
        $entry = $bucketName . ':' . $fileKey;
        $encodedEntry = url_safe_base64_encode($entry);

        global $WCS_MGR_URL;

        $url = $WCS_MGR_URL . '/fileManageCmd/delete/' . $encodedEntry;

        $token = get_file_delete_token($bucketName, $fileKey);

        return $this->_doPost($url, $token);

    }


    /**
     * 获取文件信息
     * @param $bucketName
     * @param $fileKey
     * @return mixed
     */
    public function stat($bucketName, $fileKey)
    {
        $entry = $bucketName . ':' . $fileKey;
        $encodedEntry = url_safe_base64_encode($entry);

        global $WCS_MGR_URL;

        $url = $WCS_MGR_URL . '/fileManageCmd/stat/' . $encodedEntry;

        $token = get_file_stat_token($bucketName, $fileKey);


        return $this->_doGet($url, $token);
    }

    /**
     * 执行给定的操作
     * @param $url
     * @param $token
     * @return mixed
     */
    private function _doGet($url, $token)
    {
        $headers = array("Authorization:$token");
        $resp = http_get($url, $headers);
        return $resp;
    }
    /**
     * 执行给定的操作
     * @param $url
     * @param $token
     * @return mixed
     */
    private function _doPost($url, $token)
    {
        $headers = array("Authorization:$token");
        $resp = http_post($url, $headers, null);
        return $resp;
    }
} 