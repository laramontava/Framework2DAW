<?php
    class controller_products_frontend {
        //include  with absolute route
        /*$path = $_SERVER['DOCUMENT_ROOT'] . '/Framework/';
        include($path . "modules/products_frontend/utils/utils.inc.php");-
        define('SITE_ROOT', $path);
        include $path . 'utils/filters.inc.php';-
        include $path . 'classes/Log.class.singleton.php';
        include $path . 'utils/common.inc.php';-
        include $path . 'paths.php';
        include $path . 'utils/response_code.inc.php';-
    
        $_SESSION['module'] = "products_frontend";*/
        public function __construct() {
			include(UTILS_PRODUCTS_FE . "utils.inc.php");
			include(UTILS . "filters.inc.php");
			include(UTILS . "utils.inc.php");
			include(UTILS . "response_code.inc.php");
			include(UTILS . "common.inc.php");
			include LOG_DIR;
			
			$_SESSION['module'] = "products_frontend";
   		}
        
        public function list_products() {
   			require_once(VIEW_PATH_INC."header.php"); 
			require_once(VIEW_PATH_INC."navbar.php");
	
            loadView('modules/products_frontend/view/', 'list_products.php');
            
            require_once(VIEW_PATH_INC."footer.html");
        }
        
        public function autocomplete_products() {
            if ((isset($_GET["autocomplete"])) && ($_GET["autocomplete"] === "true")) {
                set_error_handler('ErrorHandler');
                //$model_path = SITE_ROOT . 'modules/products_frontend/model/model/';
                try {
                    //$nameProducts = loadModel($model_path, "products_model", "select_column_products", "name");
                    $nameProducts = loadModel(MODEL_PRODUCTS_FE, "products_model", "select_column_products", "name");
                } catch (Exception $e) {
                    showErrorPage(2, "ERROR - 503 BD", 'HTTP/1.0 503 Service Unavailable', 503);
                }
                restore_error_handler();
            
                if ($nameProducts) {
                    $jsondata["name"] = $nameProducts;
                    echo json_encode($jsondata);
                    exit;
                } else {
            
                    showErrorPage(2, "ERROR - 404 NO DATA", 'HTTP/1.0 404 Not Found', 404);
                }
            }
        }
        
        public function name(){
            if (($_GET["name"])) {
                //filtrar $_GET["nom_product"]
                $result = filter_string($_GET["name"]);
                if ($result['resultado']) {
                    $criteria = $result['datos'];
                } else {
                    $criteria = '';
                }
                //$model_path = SITE_ROOT . 'modules/products_frontend/model/model/';
                set_error_handler('ErrorHandler');
                try {
                   
                    $arrArgument = array(
                        "column" => "name",
                        "like" => $criteria
                    );
                    //$producto = loadModel($model_path, "products_model", "select_like_products", $arrArgument);
                    $producto = loadModel(MODEL_PRODUCTS_FE, "products_model", "select_like_products", $arrArgument);
            
                    //throw new Exception(); //que entre en el catch
                } catch (Exception $e) {
                    showErrorPage(2, "ERROR - 503 BD", 'HTTP/1.0 503 Service Unavailable', 503);
                }
                restore_error_handler();
            
                if ($producto) {
                    $jsondata["product_autocomplete"] = $producto;
                    echo json_encode($jsondata);
                    exit;
                } else {
                    //if($producto){{ //que lance error si no existe el producto
                    showErrorPage(2, "ERROR - 404 NO DATA", 'HTTP/1.0 404 Not Found', 404);
                }
            }
        }
        
        public function count_products() {
            if (($_GET["count_product"])) {
                //filtrar $_GET["count_product"]
                $result = filter_string($_GET["count_product"]);
                if ($result['resultado']) {
                    $criteria = $result['datos'];
                } else {
                    $criteria = '';
                }
                //$model_path = SITE_ROOT . 'modules/products_frontend/model/model/';
                set_error_handler('ErrorHandler');
                try {
            
                    $arrArgument = array(
                        "column" => "name",
                        "like" => $criteria
                    );
                    //$total_rows = loadModel($model_path, "products_model", "count_like_products", $arrArgument);
                    $total_rows = loadModel(MODEL_PRODUCTS_FE, "products_model", "count_like_products", $arrArgument);
                    //throw new Exception(); //que entre en el catch
                } catch (Exception $e) {
                    showErrorPage(2, "ERROR - 503 BD", 'HTTP/1.0 503 Service Unavailable', 503);
                }
                restore_error_handler();
            
                if ($total_rows) {
                    $jsondata["num_products"] = $total_rows[0]["total"];
                    echo json_encode($jsondata);
                    exit;
                } else {
                    //if($total_rows){ //que lance error si no existe el producto
                    showErrorPage(2, "ERROR - 404 NO DATA", 'HTTP/1.0 404 Not Found', 404);
                }
            }
        }
        
        public function num_pages_products() {
            //obtain num total pages
            if ((isset($_GET["num_pages"])) && ($_GET["num_pages"] === "true")) {
                //filtrar $_GET["keyword"]
                if (isset($_GET["keyword"])) {
                    $result = filter_string($_GET["keyword"]);
                    if ($result['resultado']) {
                        $criteria = $result['datos'];
                    } else {
                        $criteria = '';
                    }
                } else {
                    $criteria = '';
                }
                $item_per_page = 6;
                //$model_path = SITE_ROOT . 'modules/products_frontend/model/model/';
                set_error_handler('ErrorHandler');
                try {
                    //loadmodel
                    $arrArgument = array(
                        "column" => "name",
                        "like" => $criteria
                    );
            
                    //$resultado = loadModel($model_path, "products_model", "count_like_products", $arrArgument);
                    $resultado = loadModel(MODEL_PRODUCTS_FE, "products_model", "count_like_products", $arrArgument);
                    //echo json_encode($resultado);exit;
                    $resultado = $resultado[0]["total"];
                    
                    $pages = ceil($resultado / $item_per_page); //break total records into pages
                    
                } catch (Exception $e) {
                    showErrorPage(2, "ERROR - 503 BD", 'HTTP/1.0 503 Service Unavailable', 503);
                }
                restore_error_handler();
            
                if ($resultado) {
                    $jsondata["pages"] = $pages;
                    echo json_encode($jsondata);
                    exit;
                } else {
                    //if($get_total_rows){ //que lance error si no hay productos
                    showErrorPage(2, "ERROR - 404 NO DATA", 'HTTP/1.0 404 Not Found', 404);
                }
            }
        }
        
        public function view_error_true() {
            if ((isset($_GET["view_error"])) && ($_GET["view_error"] === "true")) {
                /* paint_template_error("ERROR BD");
                  die(); */
                showErrorPage(0, "ERROR - 503 BD Unavailable", 503);
            }
        }
        
        public function view_error_false() {
            if ((isset($_GET["view_error"])) && ($_GET["view_error"] ==="false")) {
                //showErrorPage(0, "ERROR - 404 NO PRODUCTS");
                showErrorPage(0, "ERROR - 404 RESULTS NOT FOUND <br> Please, check over if you misspelled any letter of the search word");
            }
        }
    
        public function idproduct() {
            //echo json_encode($_GET["idProducto"]);exit;
            if ($_GET["idProducto"]) {
                $result = filter_num_int($_GET["idProducto"]);
                if ($result['resultado']) {
                    $id = $result['datos'];
                } else {
                    $id = 1;
                }
                set_error_handler('ErrorHandler');
                try {
                    $producto = false;
                    //$path_model = SITE_ROOT . 'modules/products_frontend/model/model/';
                    $producto = loadModel(MODEL_PRODUCTS_FE, "products_model", "details_products", $id);
                } catch (Exception $e) {
                    //header('HTTP/1.0 503 Service Unavailable', true, 503);
                    // loadView("503");
                    showErrorPage(2, "ERROR - 503 BD", 'HTTP/1.0 503 Service Unavailable', 503);
                }
                restore_error_handler();
                if ($producto) {
                    $jsondata["product"] = $producto[0];
                    echo json_encode($jsondata);
                    exit;
                } else {
                    showErrorPage(2, "ERROR - 404 NO DATA", 'HTTP/1.0 404 Not Found', 404);
                }
            }else{
                if (isset($_POST["page_num"])) {
                    $result = filter_num_int($_POST["page_num"]);
                    if ($result['resultado']) {
                        $page_number = $result['datos'];
                    }
                } else {
                    $page_number = 1;
                }
            
                $item_per_page = 6;
                
                if (isset($_GET["keyword"])) {
                    $result = filter_string($_GET["keyword"]);
                    if ($result['resultado']) {
                        $criteria = $result['datos'];
                    } else {
                        $criteria = '';
                    }
                } else {
                    $criteria = '';
                }
                
                if (isset($_POST["keyword"])) {
                    $result = filter_string($_POST["keyword"]);
                    if ($result['resultado']) {
                        $criteria = $result['datos'];
                    } else {
                        $criteria = '';
                    }
                }
            
                $position = (($page_number - 1) * $item_per_page);
                //$model_path = SITE_ROOT . 'modules/products_frontend/model/model/';
                $limit = $item_per_page;
                $arrArgument = array(
                    "column" => "name",
                    "like" => $criteria,
                    "position" => $position,
                    "limit" => $limit
                );
                set_error_handler('ErrorHandler');
                try {
            
                    //$resultado = loadModel($model_path, "products_model", "select_like_limit_products", $arrArgument);
                    $resultado = loadModel(MODEL_PRODUCTS_FE, "products_model", "select_like_limit_products", $arrArgument);
                    } catch (Exception $e) {
                    showErrorPage(0, "ERROR - 503 BD Unavailable", 503);
                }
                restore_error_handler();
            
                if ($resultado) {
            
                    paint_template_products($resultado);
                } else {
                    //paint_template_error("NO PRODUCTS");
                    showErrorPage(0, "ERROR - 404 NO PRODUCTS", 404);
                }
            }
        }
        
    }