<?php
    //SITE_ROOT
    $path = $_SERVER['DOCUMENT_ROOT'] . '/Framework/';
    define('SITE_ROOT', $path);
    
    //SITE_PATH
    define('SITE_PATH','https://'.$_SERVER['HTTP_HOST'].'/Framework/');
	
	//CSS
	define('CSS_PATH', SITE_PATH . 'view/css/');
    
    //log
    define('LOG_DIR',SITE_ROOT.'classes/Log.class.singleton.php');
    define('USER_LOG_DIR', SITE_ROOT . 'log/products/Site_Products_errors.log');
    define('GENERAL_LOG_DIR', SITE_ROOT . 'log/general/Site_General_errors.log');
    
    //production
    define('PRODUCTION',true);
    
    //model
    define('MODEL_PATH',SITE_ROOT.'model/');
    //view
    define('VIEW_PATH_INC',SITE_ROOT.'view/inc/');
    define('VIEW_PATH_INC_ERROR',SITE_ROOT.'view/inc/templates_error/');
    //modules
    define('MODULES_PATH',SITE_ROOT.'modules/');
    
    //resources
    define('RESOURCES',SITE_ROOT.'resources/');
    //media
    define('MEDIA_PATH',SITE_ROOT.'media/');
    //utils
    define('UTILS',SITE_ROOT.'utils/');
    
    //model products_frontend
    define('UTILS_PRODUCTS_FE',SITE_ROOT.'modules/products_frontend/utils/');
    define('PRODUCTS_JS_LIB_PATH',SITE_ROOT.'modules/products_frontend/view/lib/');
    define('PRODUCTS_FE_JS_PATH', SITE_PATH . 'modules/products_frontend/view/js/');
    
    define('MODEL_PATH_PRODUCTS_FE',SITE_ROOT.'modules/products_frontend/model/');
    define('MODEL_PRODUCTS_FE',SITE_ROOT.'modules/products_frontend/model/model/');
    define('BLL_PRODUCTS_FE',SITE_ROOT.'modules/products_frontend/model/BLL/');
    define('DAO_PRODUCTS_FE',SITE_ROOT.'modules/products_frontend/model/DAO/');
    
    
    