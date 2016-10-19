<?php
    function val_formproduct($product){
        $error = array();
        $valido = true;
    
        $filtro = array(
            'id' => array(
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => array('regexp' => '/^[1-9]{8}$/')
                ),
            'name' => array(
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => array('regexp' => '/^([A-Za-z ñáéíóú]{2,30})$/')
                ),
            'description' => array(
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => array('regexp' => '/^([A-Za-z ñáéíóú1-9.,;:"]{2,300})$/')
                ),
            'datepicker1' => array(
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => array('regexp' => '/^(0[1-9]|1[012])[- \/.](0[1-9]|[12][0-9]|3[01])[- \/.](19|20)\d\d$/')
                ),
            'datepicker2' => array(
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => array('regexp' => '/^(0[1-9]|1[012])[- \/.](0[1-9]|[12][0-9]|3[01])[- \/.](19|20)\d\d$/')
                ),
            'price' => array(
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => array('regexp' => '/^[1-9]{1,10}$/')
                ),
            'stock' => array(
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => array('regexp' => '/^[1-9]{1,10}$/')
                )
            );
        
        $resultado = filter_var_array($product, $filtro);
        
        $resultado['category'] = $product['category'];
        $resultado['condition'] = $product['condition'];
        $resultado['datepicker1'] = $product['datepicker1'];
        $resultado['datepicker2'] = $product['datepicker2'];
        $resultado['pais'] = $product['pais'];
        $resultado['provincia'] = $product['provincia'];
        $resultado['poblacion'] = $product['poblacion'];
        
        $dates = validate_dates($resultado['datepicker1'], $resultado['datepicker2']);
        if (!$dates) {
            $error['datepicker2'] = "Error date";
            $valido = false;
        }
        
        if(count($resultado['category']) <= 1){
            $error['category']='You have to choose 2 categories';
            $valido = false;
        }
        
        if($resultado['pais'] != 'ES'){
            $resultado[provincia] = 'default_provincia';
            $resultado[poblacion] = 'default_poblacion';
        }
        
        if($resultado != null && $resultado){
            if(!$resultado['id']){
                $error['id']='ID must be 8 numbers';
                $valido = false;
            }
            
            if(!$resultado['name']){
                $error['name']='Name must be 2 to 30 letters';
                $valido = false;
            }
            
            if(!$resultado['description']){
                $error['description']='Description must be 2 to 300 characters';
                $valido = false;
            }
            
            if(!$resultado['price']){
                $error['price']='Rate have format 000.00';
                $valido = false;
            }
            
            if(!$resultado['stock']){
                $error['stock']='Stock has only absolute numbers';
                $valido = false;
            }
        }else{
            $valido = false;
        };
        
        
        return $return = array('resultado' => $valido, 'error' => $error, 'datos' => $resultado);
        
    }
    
    function validate_dates($datepicker1, $datepicker2) {
        $day1 = substr($datepicker1, 0, 2);
        $month1 = substr($datepicker1, 3, 2);
        $year1 = substr($datepicker1, 6, 4);
        $day2 = substr($datepicker2, 0, 2);
        $month2 = substr($datepicker2, 3, 2);
        $year2 = substr($datepicker2, 6, 4);

        if (strtotime($day1 . "-" . $month1 . "-" . $year1) <= strtotime($year2 . "-" . $month2 . "-" . $day2)) {
            return true;
        }
        return false;
    }
    
    