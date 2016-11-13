<div id="list_prod" class="row text-center pad-row">
            <section id="home" class="head-main-img">

               <div class="container">
           <div class="row text-center pad-row" >
            <div class="col-md-12">
              <h1>  DETAILS PRODUCTS  </h1>
                </div>
               </div>
            </div>

       </section>
    <!--/.HEADING END -->
<section >
    <div class="container">

        <?php
        if (isset($arrData) && !empty($arrData)) {
            ?>   
            <div class="media">
                <div class="pull-left">
                    <img src="<?php echo $arrData['avatar']?>" class="img-product" id="avatar">
                </div>
                <div class="media-body">
                    <h3 class="media-heading title-product"><?php echo $arrData['name'] ?></h3>
                    <p class="text-limited"><?php echo $arrData['description'] ?></p>
                    <br>
                    <h5 class="special"> <strong>Precio: <?php echo $arrData['price'] ?>€</strong> </h5>


                </div>
            </div>
            <?php
        }
        ?> 

    </div>
</section>