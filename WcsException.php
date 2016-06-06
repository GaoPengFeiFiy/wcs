<?php
/**
 * Created by PhpStorm.
 * User: lv
 * Date: 16/6/6
 * Time: 上午11:13
 */

namespace Outyua\Wcs;

class WcsException extends \Exception {

    //static var




    public function __construct($code, $message="", \Exception $previous=null)
    {
        $this->code = $code;
        $this->setMessage($code, $message);
        parent::__construct($this->message, $this->code, $previous);
    }
    private function setMessage($code, $message="") {
        switch($code) {
            case 1:
                $this->message = '111';
                break;
            default :
                $this->message = $message;
                break;
        }
    }
}