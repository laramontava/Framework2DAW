//upload, delete, load_data, alta

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

    /////////////Datepicker/////////////
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

    /////////////validate products/////////////
    $("#submit_products").click(function () {
        validate_product();
    });

    /////////////turn back clean the form/////////////
 /*   $.get("modules/products/controller/controller_products.class.php",//$.get("modules/products/controller_products.class.php?load_data=true",
        function(response){

            if(response.products === ""){
                $("#id").val('');


            }else{
                $("#id").val(response.products.id);
            }

    }, "json");*/

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
                console.log(response);
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
                    console.log(data);
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
});
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
    var category = [];
    var inputElements = document.getElementsByClassName('messageCheckbox');
    var j = 0;
    for (var i = 0; i < inputElements.length; i++) {
        if (inputElements[i].checked) {
            category[j] = inputElements[i].value;
            j++;
        }
    }
    var accept = document.getElementsByName('accept').value;
    //console.log(accept);
    //Validations
    var id_regexpr = /^[1-9]{8}$/;
    var string_regexpr = /^[A-Z,a-z]{2,30}$/;
    var date_regexpr = /^(0?[1-9]|[12][0-9]|3[01])[\/](0?[1-9]|1[012])[/\\/](19|20)\d{2}$/;
    var int_regexpr = /^[1-9]{1,10}$/;


    $(".error").remove();
    if ($("#id").val() == "" || $("#id").val() === "Introduce product ID") {
        $("#id").focus().after("<span class='error'>Introduce product ID</span>");
        result = false;
        return false;
    } else if (!id_regexpr.test($("#id").val())) {
        $("#id").focus().after("<span class='error'>ID must be 8 numbers</span>");
        result = false;
        return false;
    }

    if($("#name").val() == "" || $("#name").val() === "Introduce product name") {
        $("#name").focus().after("<span class='error'>Introduce product name</span>");
        result = false;
        return false;
    } else if (!string_regexpr.test($("#name").val())){
        $("#name").focus().after("<span class='error'>Name must be 2 to 30 letters</span>");
        result = false;
        return false;
    }

    if($("#description").val() == "" || $("#description").val() === "Introduce a description") {
        $("#description").focus().after("<span class='error'>Introduce a description</span>");
        result = false;
        return false;
    }

    if($("#datepicker1").val() == "" || $("#datepicker1").val() === "Introduce a date") {
        $("#datepicker1").focus().after("<span class='error'>Introduce product name</span>");
        result = false;
        return false;
    } else if (!date_regexpr.test($("#datepicker1").val())){
        $("#datepicker1").focus().after("<span class='error'>Date have format dd/mm/yyyy</span>");
        result = false;
        return false;
    }

    if($("#datepicker2").val() == "" || $("#datepicker2").val() === "Introduce a refund date") {
        $("#datepicker2").focus().after("<span class='error'>Introduce product name</span>");
        result = false;
        return false;
    } else if (!date_regexpr.test($("#datepicker2").val())){
        $("#datepicker2").focus().after("<span class='error'>Date have format dd/mm/yyyy</span>");
        result = false;
        return false;
    }

    if($("#price").val() == "" || $("#price").val() === "Introduce a product rate") {
        $("#price").focus().after("<span class='error'>Introduce product rate</span>");
        result = false;
        return false;
    } else if (!int_regexpr.test($("#price").val())){
        $("#price").focus().after("<span class='error'>Rate have format 000.00</span>");
        result = false;
        return false;
    }

    if($("#stock").val() == "" || $("#stock").val() === "Introduce a product stock") {
        $("#stock").focus().after("<span class='error'>Introduce product stock</span>");
        result = false;
        return false;
    } else if (!int_regexpr.test($("#stock").val())){
        $("#stock").focus().after("<span class='error'>Stock has only absolute numbers</span>");
        result = false;
        return false;
    }


    if(result){
        var data = {"id":id, "name":name, "description":description, "condition":condition,
            "datepicker1":datepicker1, "datepicker2":datepicker2,"price":price,"stock":stock,
            "category":category, "accept":accept};

        var data_products_JSON = JSON.stringify(data);
        console.log(data_products_JSON);

        $.post('modules/products/controller/controller_products.class.php',
            {alta_products_json: data_products_JSON},
        function (response) {
            if (response.success) {
                window.location.href = response.redirect;

            //    console.log(redirect1);
                console.log("correctamente");
            }
            console.log(response);
//        }, "json").fail(function (xhr){
//            console.log(xhr.responseJSON);
//            console.log("fail");
     /*       if (xhr.responseJSON.error.id)
                $("#id").focus().after("<span class='error1'>" + xhr.responseJSON.error.id + "</span>");

            if (xhr.responseJSON.error.name)
                $("#name").focus().after("<span  class='error1'>" + xhr.responseJSON.error.name + "</span>");

            if (xhr.responseJSON.success1) {
                if (xhr.responseJSON.img_avatar !== "/PhpProject1/media/default-avatar.png") {
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
            */
            });
        } /////end result

    //    $("#form_products").submit();
    //    $("#form_products").attr("action", "index.php?module=products");
}
