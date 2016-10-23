jQuery.fn.fill_or_clean = function () {
    this.each(function () {
        if ($("#id").val() === "") {
            $("#id").val("Introduce product ID");//.val
            $("#id").focus(function () {
                if ($("#id").val() === "Introduce product ID") {
                    $("#id").val("");
                }
            });
        }
        $("#id").blur(function(){
            if($("#id").val() === ""){
                $("#id").val("Introduce product ID");
                $("#id").val("Introduce product ID");
            }

            });

        if ($("#name").val() === "") {
            $("#name").val("Introduce product name");
            $("#name").focus(function () {
                if ($("#name").val() == "Introduce product name") {
                    $("#name").val("");
                }
            });
        }
        $("#name").blur(function(){
            if($("#name").val() === ""){
                $("#name").val("Introduce product name");
            }

            });

    });
    return this;
};

Dropzone.autoDiscover = false;
$(document).ready(function () {
//////////////////////////////////////////////
/////////////     Datepicker     /////////////
//////////////////////////////////////////////
    $( "#datepicker1" ).datepicker({
    		    dateFormat: 'dd/mm/yy',
			    changeMonth: true,
			    changeYear: true,
    		});

    $( "#datepicker2" ).datepicker({
    		    dateFormat: 'dd/mm/yy',
			    changeMonth: true,
			    changeYear: true,
    		});

    $(this).fill_or_clean();

    //////////////////////////////////////////////
    /*              Validate Products           */
    //////////////////////////////////////////////
    $("#submit_products").click(function () {
        validate_product();
    });

    /////////////turn back clean the form/////////////
    $.get("modules/products/controller/controller_products.class.php?load_data=true",
        function(response){
            if(response.product === ""){
                $("#id").val('');
                $("#name").val('');
                $("#description").val('');
                $("#condition").val('New');
                $("#datepicker1").val('');
                $("#datepicker2").val('');
                $("#price").val('');
                $("#stock").val('');
                var inputElements = document.getElementsByClassName('messageCheckbox');
                    for (var i = 0; i < inputElements.length; i++) {
                        if (inputElements[i].checked) {
                            inputElements[i].checked = false;
                        }
                    }
            }else{
                $("#id").val(response.product.id);
                $("#name").val(response.product.name);
                $("#description").val(response.product.description);
                $("#condition").val(response.product.condition);
                $("#datepicker1").val(response.product.datepicker1);
                $("#datepicker2").val(response.product.datepicker2);
                $("#price").val(response.product.price);
                $("#stock").val(response.product.stock);
                var category = response.product.category;
                    var inputElements = document.getElementsByClassName('messageCheckbox');
                    for (var i = 0; i < category.length; i++) {
                        for (var j = 0; j < inputElements.length; j++) {
                            if(category[i] ===inputElements[j] )
                                inputElements[j].checked = true;
                        }
                    }
            }
    }, "json");

//////////////////////////////////////////////
//                 DROPZONE
//////////////////////////////////////////////
    $("#dropzone").dropzone({
        url: "modules/products/controller/controller_products.class.php?upload=true",
        addRemoveLinks:true,
        maxFileSize:1000,
        dictResponseError:"Error",
        acceptedFiles: 'image/*,.jpeg,.jpg,.png,.gif,.JPEG,.JPG,.PNG,.GIF,.rar,application/pdf,.psd',
        init: function(){
            this.on("success", function(file, response){
                $("#progress").show();
                $("#bar").width('100%');
                $("#percent").html('100%');
                $('.msg').text('').removeClass('msg_error');
                $('.msg').text('Success image upload').addClass('msg_ok').animate({'right':'300px'}, 300);
          //      console.log(response);
            });
        },
        complete: function (file) {
            //if(file.status == "success"){
            //alert("El archivo se ha subido correctamente: " + file.name);
            //}
        },
        error: function (file) {
            //alert("Error subiendo el archivo " + file.name);
        },
        removedfile: function (file, serverFileName) {
            var name = file.name;
            $.ajax({
                type: "POST",
                url: "modules/products/controller/controller_products.class.php?delete=true",
                data: "filename=" + name,
                success: function (data) {
                    $("#progress").hide();
                    $('.msg').text('').removeClass('msg_ok');
                    $('.msg').text('').removeClass('msg_error');
                    $("#e_avatar").html("");

                    var json = JSON.parse(data);
             //       console.log(data);
                    console.log("dropzone");
                    if (json.res === true) {
                        var element;
                        if ((element = file.previewElement) != null) {
                            element.parentNode.removeChild(file.previewElement);
                        } else {
                            false;
                        }
                    } else {
                        var element;
                        if ((element = file.previewElement) != null) {
                            element.parentNode.removeChild(file.previewElement);
                        } else {
                            false;
                        }
                    }
                }
            });
        }
    }); //END dropzone

    $("#id").keyup(function () {
        if ($(this).val() != "" && $(this).val() == $('#id').val()) {
            $(".error").fadeOut();
            return false;
        }
    });

    $("#name").keyup(function () {
        if ($(this).val() != "" && $(this).val() == $('#name').val()) {
            $(".error").fadeOut();
            return false;
        }
    });

    $("#description").keyup(function () {
        if ($(this).val() != "" && $(this).val() == $('#description').val()) {
            $(".error").fadeOut();
            return false;
        }
    });

    $("#datepicker1").keyup(function() {
       if($(this).val() != "" && $(this).val() == $('#datepicker1').val()) {
           $(".error").fadeOut();
           return false;
       }
    });

    $("#datepicker2").keyup(function() {
       if($(this).val() != "" && $(this).val() == $('#datepicker2').val()) {
           $(".error").fadeOut();
           return false;
       }
    });

    $("#price").keyup(function() {
       if($(this).val() != "" && $(this).val() == $('#price').val()) {
           $(".error").fadeOut();
           return false;
       }
    });

    $("#stock").keyup(function() {
       if($(this).val() != "" && $(this).val() == $('#stock').val()) {
           $(".error").fadeOut();
           return false;
       }
    });
    $("#pais").keyup(function() {
        if($(this).val() == "" || $(this).val() == "Selecciona un Pais"){
            $(".error").fadeOut();
           return false;
        }
    });
    $("#provincia").keyup(function() {
        if($(this).val() == "Selecciona una Provincia"){
            $(".error").fadeOut();
           return false;
        }
    });
    $("#poblacion").keyup(function() {
        if($(this).val() == "Selecciona una Poblacion"){
            $(".error").fadeOut();
           return false;
        }
    });
    //////////  COMBOBOX COUNTRIES ///////////
    load_countries_v1();
    $("#provincia").empty();
    $("#provincia").append('<option value="" selected="selected">Selecciona una Provincia</option>');
    $("#provincia").prop('disabled', true);
    $("#poblacion").empty();
    $("#poblacion").append('<option value="" selected="selected">Selecciona una Poblacion</option>');
    $("#poblacion").prop('disabled', true);

    $("#pais").change(function() {
        var pais = $(this).val();
        var provincia = $("#provincia");
        var poblacion = $("#poblacion");

        if(pais !== 'ES'){
            provincia.prop('disabled', true);
            poblacion.prop('disabled', true);
            $("#provincia").empty();
            $("#poblacion").empty();
        }else{
            provincia.prop('disabled', false);
            poblacion.prop('disabled', false);
            load_provincias_v1();
        }//fi else
    });

    $("#provincia").change(function() {
        var prov = $(this).val();
        if(prov > 0){
            load_poblaciones_v1(prov);
        }else{
            $("#poblacion").prop('disabled', false);
        }
    });
});//   END ready

function load_countries_v2(cad) {
    $.getJSON( cad, function(data) {
      $("#pais").empty();
      $("#pais").append('<option value="" selected="selected">Selecciona un Pais</option>');
      
      $.each(data, function (i, valor) {
        $("#pais").append("<option value='" + valor.sISOCode + "'>" + valor.sName + "</option>");
      });
    })
    .fail(function() {
        alert( "error load_countries" );
    });
}

function load_countries_v1() {
    $.get( "modules/products/controller/controller_products.class.php?load_pais=true",
        function( response ) {
            //console.log(response);
            if(response === 'error'){
                load_countries_v2("resources/ListOfCountryNamesByName.json");
            }else{
                load_countries_v2("modules/products/controller/controller_products.class.php?load_pais=true"); //oorsprong.org
            }
    })
    .fail(function(response) {
        load_countries_v2("resources/ListOfCountryNamesByName.json");
    });
}

function load_provincias_v2() {
    $.get("resources/provinciasypoblaciones.xml", function (xml) {
	    $("#provincia").empty();
	    $("#provincia").append('<option value="" selected="selected">Selecciona una Provincia</option>');
	            
        $(xml).find("provincia").each(function () {
            var id = $(this).attr('id');
            var nombre = $(this).find('nombre').text();
            $("#provincia").append("<option value='" + id + "'>" + nombre + "</option>");
        });
    })
    .fail(function() {
        alert( "error load_provincias" );
    });
}

function load_provincias_v1() { //provinciasypoblaciones.xml - xpath
   $.get( "modules/products/controller/controller_products.class.php?load_provincias=true", 
        function( response ) {
            $("#provincia").empty();
	        $("#provincia").append('<option value="" selected="selected">Selecciona una Provincia</option>');
	    
            //alert(response);
            var json = JSON.parse(response);
		    var provincias=json.provincias;
		    //alert(provincias);
		    //console.log(provincias);

		    //alert(provincias[0].id);
		    //alert(provincias[0].nombre);
    		
            if(provincias === 'error'){
                load_provincias_v2();
            }else{
                for (var i = 0; i < provincias.length; i++) { 
        		    $("#provincia").append("<option value='" + provincias[i].id + "'>" + provincias[i].nombre + "</option>");
    		    }
            }
    })
    .fail(function(response) {
        load_provincias_v2();
    });
}

function load_poblaciones_v2(prov) {
    $.get("resources/provinciasypoblaciones.xml", function (xml) {
		$("#poblacion").empty();
	    $("#poblacion").append('<option value="" selected="selected">Selecciona una Poblacion</option>');
			    
		$(xml).find('provincia[id=' + prov + ']').each(function(){
    		$(this).find('localidad').each(function(){
    			 $("#poblacion").append("<option value='" + $(this).text() + "'>" + $(this).text() + "</option>");
    		});  
        });
	})
	.fail(function() {
        alert( "error load_poblaciones" );
    });
}

function load_poblaciones_v1(prov) { //provinciasypoblaciones.xml - xpath
    var datos = { idPoblac : prov  };
	$.post("modules/products/controller/controller_products.class.php", datos, function(response) {
	    //alert(response);
        var json = JSON.parse(response);
		var poblaciones=json.poblaciones;
		//alert(poblaciones);
		//console.log(poblaciones);
		//alert(poblaciones[0].poblacion);

		$("#poblacion").empty();
	    $("#poblacion").append('<option value="" selected="selected">Selecciona una Poblacion</option>');

        if(poblaciones === 'error'){
            load_poblaciones_v2(prov);
        }else{
            for (var i = 0; i < poblaciones.length; i++) { 
        		$("#poblacion").append("<option value='" + poblaciones[i].poblacion + "'>" + poblaciones[i].poblacion + "</option>");
    		}
        }
	})
	.fail(function() {
        load_poblaciones_v2(prov);
    });
}

function validate_product(){

    var result = true;

    //coger valores formulario
    var id = document.getElementById('id').value;
    var name = document.getElementById('name').value;
    var description = document.getElementById('description').value;
    var condition = document.getElementById('condition').value;
    var datepicker1 = document.getElementById('datepicker1').value;
    var datepicker2 = document.getElementById('datepicker2').value;
    var price = document.getElementById('price').value;
    var stock = document.getElementById('stock').value;
    var pais = document.getElementById('pais').value;
    var provincia = document.getElementById('provincia').value;
    var poblacion = document.getElementById('poblacion').value;
    var category = [];
    var inputElements = document.getElementsByClassName('messageCheckbox');
    var j = 0;
    for (var i = 0; i < inputElements.length; i++) {
        if (inputElements[i].checked) {
            category[j] = inputElements[i].value;
            j++;
        }
    }
    //var accept = document.getElementsByName('accept').value;
    
    //Validations
    var id_regexpr = /^[1-9]{8}$/;
    var string_regexpr = /^[A-Z,a-z]{2,30}$/;
    var date_regexpr = /^(0?[1-9]|[12][0-9]|3[01])[\/](0?[1-9]|1[012])[/\\/](19|20)\d{2}$/;
    var int_regexpr = /^[1-9]{1,10}$/;

    $(".error").remove();
    if ($("#id").val() === "" || $("#id").val() === "Introduce product ID") {
        $("#id").focus().after("<span class='error'>Introduce product ID</span>");
        result = false;
        return false;
    } else if (!id_regexpr.test($("#id").val())) {
        $("#id").focus().after("<span class='error'>ID must be 8 numbers</span>");
        result = false;
        return false;
    }

    if($("#name").val() === "" || $("#name").val() === "Introduce product name") {
        $("#name").focus().after("<span class='error'>Introduce product name</span>");
        result = false;
        return false;
    } else if (!string_regexpr.test($("#name").val())){
        $("#name").focus().after("<span class='error'>Name must be 2 to 30 letters</span>");
        result = false;
        return false;
    }

    if($("#description").val() === "" || $("#description").val() === "Introduce a description") {
        $("#description").focus().after("<span class='error'>Introduce a description</span>");
        result = false;
        return false;
    }

    if($("#datepicker1").val() === "" || $("#datepicker1").val() === "Introduce a date") {
        $("#datepicker1").focus().after("<span class='error'>Introduce product date</span>");
        result = false;
        return false;
    } else if (!date_regexpr.test($("#datepicker1").val())){
        $("#datepicker1").focus().after("<span class='error'>Date have format dd/mm/yyyy</span>");
        result = false;
        return false;
    }

    if($("#datepicker2").val() === "" || $("#datepicker2").val() === "Introduce a refund date") {
        $("#datepicker2").focus().after("<span class='error'>Introduce product refund date</span>");
        result = false;
        return false;
    } else if (!date_regexpr.test($("#datepicker2").val())){
        $("#datepicker2").focus().after("<span class='error'>Date have format dd/mm/yyyy</span>");
        result = false;
        return false;
    }

    if($("#price").val() === "" || $("#price").val() === "Introduce a product rate") {
        $("#price").focus().after("<span class='error'>Introduce product rate</span>");
        result = false;
        return false;
    } else if (!int_regexpr.test($("#price").val())){
        $("#price").focus().after("<span class='error'>Rate have format 000.00</span>");
        result = false;
        return false;
    }

    if($("#stock").val() === "" || $("#stock").val() === "Introduce a product stock") {
        $("#stock").focus().after("<span class='error'>Introduce product stock</span>");
        result = false;
        return false;
    } else if (!int_regexpr.test($("#stock").val())){
        $("#stock").focus().after("<span class='error'>Stock has only absolute numbers</span>");
        result = false;
        return false;
    }
    if($("#pais").val() === "" || $("#pais").val() === "Selecciona un Pais" || $("#pais").val().length == 0) {
        $("#pais").focus().after("<span class='error'>Select a country</span>");
        result = false;
        return false;
    }
    /*if($("#provincia").val() == null || $("#provincia").val().length == 0) {
        console.log("provincia no tiene");
        return 'default_provincia';
    }else if($("#provincia").val() === "Selecciona una Provincia"){
        console.log("seleccionar provincia aparece");
        $("#provincia").focus().after("<span class='error'>Select a provincia</span>");
        result = false;
        return false;
    }*/
    if($("#pais").val() != "ES"  && ($("#provincia").val() == null || $("#provincia").val().length == 0)){
        //return 'default_provincia';
    }else if($("#pais").val() != "ES"  && $("#provincia").val() == "Selecciona una Provincia"){
        $("#provincia").focus().after("<span class='error'>Error</span>");
        result = false;
        return false;
    }else if($("#pais").val() == "ES"  && ($("#provincia").val() == null || $("#provincia").val().length == 0 
    || $("#provincia").val() === "Selecciona una Provincia")){
        $("#provincia").focus().after("<span class='error'>Select a provincia</span>");
        result = false;
        return false;
    }
    
    if($("#pais").val() != "ES"  && ($("#poblacion").val() == null || $("#poblacion").val().length == 0)){
        //console.log($("#poblacion").val());
        //return 'default_provincia';
    }else if($("#pais").val() != "ES"  && $("#poblacion").val() == "Selecciona una Poblacion"){
        $("#poblacion").focus().after("<span class='error'>Error</span>");
        result = false;
        return false;
    }else if($("#pais").val() == "ES"  && ($("#poblacion").val() == null || $("#poblacion").val().length == 0 
    || $("#poblacion").val() === "Selecciona una Poblacion")){
        $("#poblacion").focus().after("<span class='error'>Select a poblacion</span>");
        result = false;
        return false;
    }
    

    // Todo correcto
    if(result){
        var data = {
            "id":id, 
            "name":name, 
            "description":description, 
            "condition":condition,
            "datepicker1":datepicker1, 
            "datepicker2":datepicker2,
            "price":price,
            "stock":stock,
            "category":category,
            "pais":pais,
            "provincia":provincia,
            "poblacion":poblacion
        };
        
        var data_products_JSON = JSON.stringify(data);

        $.post('modules/products/controller/controller_products.class.php',
            {alta_products_json: data_products_JSON},
        function (response) {
            console.log(response);
            
            if (response.success) {
                window.location.href = response.redirect;
                
            }
            
        }, "json").fail(function (xhr){
            
            console.log("fail");
            
            if (xhr.responseJSON.error.id)
                $("#e_id").focus().after("<span class='error1'>" + xhr.responseJSON.error.id + "</span>");
            if (xhr.responseJSON.error.name)
                $("#e_name").focus().after("<span  class='error1'>" + xhr.responseJSON.error.name + "</span>");
            if (xhr.responseJSON.error.description)
                $("#e_description").focus().after("<span  class='error1'>" + xhr.responseJSON.error.description + "</span>");
            if (xhr.responseJSON.error.datepicker2)
                $("#e_datepicker2").focus().after("<span class='error1'>" + xhr.responseJSON.error.datepicker2 + "</span>");
            if (xhr.responseJSON.error.price)
                $("#e_price").focus().after("<span class='error1'>" + xhr.responseJSON.error.price + "</span>");
            if (xhr.responseJSON.error.stock)
                $("#e_stock").focus().after("<span class='error1'>" + xhr.responseJSON.error.stock + "</span>");
            if (xhr.responseJSON.error.category)
                $("#e_category").focus().after("<span class='error1'>" + xhr.responseJSON.error.category + "</span>");
                
            if (xhr.responseJSON.success1) {
                if (xhr.responseJSON.img_avatar !== "/Framework/media/default-avatar.png") {
                    //$("#progress").show();
                    //$("#bar").width('100%');
                    //$("#percent").html('100%');
                    //$('.msg').text('').removeClass('msg_error');
                    //$('.msg').text('Success Upload image!!').addClass('msg_ok').animate({ 'right' : '300px' }, 300);
                }
            } else {
                $("#progress").hide();
                $('.msg').text('').removeClass('msg_ok');
                $('.msg').text('Error Upload image!!').addClass('msg_error').animate({'right': '300px'}, 300);
            }
            
            });
        } /////  END result
}