<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/dropzone.css">

<script type="text/javascript" src="modules/products/view/js/controller_products.js" ></script>
       <section id="home" class="head-main-img">

               <div class="container">
           <div class="row text-center pad-row" >
            <div class="col-md-12">
              <h1>  CREATE PRODUCTS  </h1>
                </div>
               </div>
            </div>

       </section>
    <!--/.HEADING END -->
    <br>
    <form id="form_products" name="form_products">

          <div class="form-group">
            <label for="id">Product ID:</label>
            <input class="form-control" name="id" placeholder="Introduce product ID" type="text" id="id" value="">
            <div id="e_id"></div>
          </div>

          <div class="form-group">
            <label for="name">Product name:</label>
            <input class="form-control" name="name" placeholder="Introduce product name" type="text" id="name" value="">
            <div id="e_name"></div>
          </div>

          <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" name="description" placeholder="Description" type="text" id="description"
            value=""></textarea>
            <div id="e_description"></div>
          </div>

          <div class="form-group">
            <label for="condition">Condition</label>
            <select name="condition" id="condition">
                <option value="New">New</option>
                <option value="Used">Second hand</option>
            </select>
          </div>

          <div class="form-group">
              <label for="date1">Date:</label>
              <input class="form-control" id="datepicker1" type="text" name="datepicker1" value = "">
              <div id="e_datepicker1"></div>
          </div>

          <div class="form-group">
              <label for="date2">Refund date:</label>
              <input class="form-control" id="datepicker2" type="text" name="datepicker2" value = "">
              <div id="e_datepicker2"></div>
          </div>

          <div class="form-group">
            <label for="price">Rate:</label>
            <input class="form-control" name="price" placeholder="Price" type="text" id="price" value="">
            <div id="e_price"></div>
          </div>

          <div class="form-group">
            <label for="stock">Stock:</label>
            <input class="form-control" name="stock" placeholder="Stock" type="text" id="stock" value="">
            <div id="e_stock"></div>
          </div>

          <div class="form-group"> <br>
            <label for="category">Category:</label><br>
            <input type="checkbox" name="category[]" class="messageCheckbox" value="Informatica"> Informática <br>
					  <input type="checkbox" name="category[]" class="messageCheckbox" value="Deporte"> Deporte <br>
					  <input type="checkbox" name="category[]" class="messageCheckbox" value="Ropa"> Ropa <br>
					  <input type="checkbox" name="category[]" class="messageCheckbox" value="Música"> Música <br>
					  <div id="e_category"></div>
          </div>

          <div class="form-group">
            <label for="accept">Admitir pedidos:</label><br>
            <input class="accept" name="accept" type="radio" value="Accept" checked> Permitir pedidos <br>
				    <input class="accept" name="accept" type="radio" value="Deny"> Denegar pedidos <br>
          </div>

          <div class="form-group" id="progress">
            <div id="bar"></div>
            <div id="percent">0%</div >
          </div>

          <div class="msg"></div><br/>
          <div id="dropzone" class="dropzone"></div><br/>

          <div class="form-group">
            <button type="button" id="submit_products" name="submit_products">Enviar</button>
          </div>


        </form>
