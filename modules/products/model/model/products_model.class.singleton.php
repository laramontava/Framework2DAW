<?php
$path = $_SERVER['DOCUMENT_ROOT'] . '/Framework/';
define('SITE_ROOT', $path);
require(SITE_ROOT . "modules/products/model/BLL/products_bll.class.singleton.php");

class user_model {

    private $bll;
    static $_instance;

    private function __construct() {
        $this->bll = user_bll::getInstance();
    }

    public static function getInstance() {
        if (!(self::$_instance instanceof self))
            self::$_instance = new self();
        return self::$_instance;
    }

    public function create_user($arrArgument) {
        return $this->bll->create_user_BLL($arrArgument);
    }

}
