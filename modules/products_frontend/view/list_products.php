<div id="list_prod" class="row text-center pad-row">
            <section id="home" class="head-main-img">

               <div class="container">
           <div class="row text-center pad-row" >
            <div class="col-md-12">
              <h1>  LIST PRODUCTS  </h1>
                </div>
               </div>
            </div>

       </section>
    <!--/.HEADING END -->

<script type="text/javascript" src="modules/products_frontend/view/js/jquery.bootpag.min.js"></script>
<script type="text/javascript" src="modules/products_frontend/view/js/list_products.js" ></script>

<center>
    <form name="search_prod" id="search_prod" class="search_prod">
        <input type="text" value="" placeholder="Search Product ..." class="input_search" id="keyword" list="datalist">
        <input name="Submit" id="Submit" class="button_search" type="button" />
    </form>
</center>

<div id="results"></div>

<center>
    <div class="pagination_prods"></div>
</center>

<!-- modal window details_product -->
<section id="product">

    <div id="details_prod" hidden>

        <div id="details">
            <div id="avatar" class="avatar"></div> 

            <div id="container">

                <h4> <strong><div id="name"></div></strong> </h4>
                <br />
                <p>
                <div id="description"></div>
                </p>
                <h2> <strong><div id="price"></div></strong> </h5>    

            </div>

        </div>

    </div>
</section>