<?php
echo json_encode("dentro de bll");
exit;
/*
$path = $_SERVER['DOCUMENT_ROOT'] . '/Framework/';
define('SITE_ROOT', $path);
define('MODEL_PATH', SITE_ROOT . 'model/');

require (MODEL_PATH . "Db.class.singleton.php");
require(SITE_ROOT . "modules/products/model/DAO/products_dao.class.singleton.php");

class user_bll {

    private $dao;
    private $db;
    static $_instance;

    private function __construct() {
        $this->dao = userDAO::getInstance();
        $this->db = Db::getInstance();
    }

    public static function getInstance() {
        if (!(self::$_instance instanceof self))
            self::$_instance = new self();
        return self::$_instance;
    }

    public function create_user_BLL($arrArgument) {
        return $this->dao->create_user_DAO($this->db, $arrArgument);
    }

}
