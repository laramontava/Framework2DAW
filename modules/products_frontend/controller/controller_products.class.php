<?php
    //include  with absolute route
    $path = $_SERVER['DOCUMENT_ROOT'] . '/Framework/';
    
    include($path . "modules/products_frontend/utils/utils.inc.php");
    define('SITE_ROOT', $path);

    include $path . 'paths.php';
    include $path . 'classes/Log.class.singleton.php';
    
    include $path . 'utils/common.inc.php';
    include $path . 'utils/filters.inc.php';
    include $path . 'utils/response_code.inc.php';

    $_SESSION['module'] = "products_frontend";
    
    //obtain num total pages
    if ((isset($_GET["num_pages"])) && ($_GET["num_pages"] === "true")) {
        $item_per_page = 3;
        $path_model = SITE_ROOT . '/modules/products_frontend/model/model/';
    
        //change work error apache
        set_error_handler('ErrorHandler');
    
        try {
            //throw new Exception();
            $arrValue = loadModel($path_model, "products_model", "total_products");
            $get_total_rows = $arrValue[0]["total"]; //total records
            $pages = ceil($get_total_rows / $item_per_page); //break total records into pages
        } catch (Exception $e) {
            showErrorPage(2, "ERROR - 503 BD", 'HTTP/1.0 503 Service Unavailable', 503);
        }
    
        //change to defualt work error apache
        restore_error_handler();
    
        if ($get_total_rows) { 
            $jsondata["pages"] = $pages;
            echo json_encode($jsondata);
            exit;
        } else {
            showErrorPage(2, "ERROR - 404 NO DATA", 'HTTP/1.0 404 Not Found', 404);
        }
    
    }

    