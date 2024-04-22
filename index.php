<?php include('partial/header.php') ?>

<!-- Hero Section -->

<section id="home">
  <div class="container">
    <h5>New Arrivals</h5>
    <h1>Best Price For This Season</h1>
    <p>Get the best quality products at the best price</p>

    <button type="submit" name="submit">
      <a href="" class="shopNow">Shop Now</a>
    </button>
  </div>
</section>

<!-- feature -->

<section id="feature" class="container mt-5">
  <h1 class="text-center mb-4">Our Feature</h1>

  <div class="row p-0 m-0">
    <div class="feature col-lg-3 col-md-6 col-sm-12">
      <img src="assests/images/quality.png" alt="feature" class="img-fluid" />
    </div>
    <div class="feature col-lg-3 col-md-6 col-sm-12">
      <img src="assests/images/free.png" alt="feature" class="img-fluid" />
    </div>
    <div class="feature col-lg-3 col-md-6 col-sm-12">
      <img src="assests/images/payments.png" alt="feature" class="img-fluid" />
    </div>
    <div class="feature col-lg-3 col-md-6 col-sm-12">
      <img src="assests/images/24.png" alt="feature" class="img-fluid" />
    </div>
  </div>
</section>

<!-- brand -->

<!-- <section id="brand" class="container mt-5">
          <h1 class="text-center mb-4">Our Brands</h1>
          <div class="row p-0 m-0">
            <div class="one col-lg-3 col-md-6 col-sm-12">
              <img src="assests/images/brand1.png" alt="brand" class="img-fluid ">
            </div>
            <div class=" one col-lg-3 col-md-6 col-sm-12">
              <img src="assests/images/brand2.png" alt="brand" class="img-fluid">
            </div>
            <div class="one col-lg-3 col-md-6 col-sm-12">
              <img src="assests/images/brand3.png" alt="brand" class="img-fluid">
            </div>
            <div class="one col-lg-3 col-md-6 col-sm-12">
              <img src="assests/images/brand4.png" alt="brand" class="img-fluid">
            </div>
          </div>

        </section> -->

<!-- new Products-->

<section id="new" class="w-100 container">
  <h1 class="text-center mb-4">Our Products</h1>

  <div class="row">
    <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
      <img src="assests/images/shoe.png" alt="new" class="img-fluid" />
      <div class="detail">
        <h2>Shoes</h2>
        <button>Shop Now</button>
      </div>
    </div>
    <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
      <img src="assests/images/shoe.png" alt="new" class="img-fluid" />
      <div class="detail">
        <h2>Shoes</h2>
        <button>Shop Now</button>
      </div>
    </div>
    <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
      <img src="assests/images/shoe.png" alt="new" class="img-fluid" />
      <div class="detail">
        <h2>Shoes</h2>
        <button>Shop Now</button>
      </div>
    </div>
  </div>
</section>

<section id="sell" class="w-100 container">
  <h1 class="text-center mb-4">Quick Sell</h1>
  <hr class="mx-auto" />
  <h3 class="text-center">Hurry Up, Grab your valubale oppurtunity</h3>
  <div class="row">

    <?php include('database/get-product.php') ?>
    <?php while ($product = $featured_products->fetch_assoc()) { ?>
      <div class="one col-lg-3 col-md-6 col-sm-12 p-0">
        <img src="assests/images/<?php echo $product['product_image']; ?>" alt="new" class="img-fluid" />
        <div class="detail">
          <h2><?php echo $product['product_name']; ?></h2>
          <h4>$<?php echo $product['product_price']; ?></h4>
          <a href="single_product.php?product_id=<?php echo $product['product_id'];?>"><button class="buy-btn">Buy Now</button></a>
        </div>
      </div>
    <?php } ?>
  </div>
</section>

<section id="banner">
  <div class="container">
    <h4>Special Season Offers</h4>
    <h2>Winter Collection <br />Up To 50%</h2>
    <button type="submit" name="submit">
      <a href="" class="shopNow mx-auto">Shop Now</a>
    </button>
  </div>
</section>

<section id="sellNew" class="w-100 container">
  <h1 class="text-center mb-4 mt-3">Shoes</h1>
  <hr class="mx-auto" />
  <h3 class="text-center mb-5">
    Step into style with our latest collection of shoes!
  </h3>
  <div class="row">
  <?php include('database/get_shoe.php') ?>
  <?php while ($row = $shoes->fetch_assoc()) { ?>
    <div class="one col-lg-3 col-md-6 col-sm-12 p-0">
      <img src="assests/images/shoe.png" alt="new" class="img-fluid" />
      <div class="detail">
        <h2>Shoes</h2>
        <h4>$99.99</h4>
        <button class="buy-btn">Buy Now</button>
      </div>
    </div>
    <?php } ?>
    
  </div>
</section>

<section id="sellNew" class="w-100 container">
  <h1 class="text-center mb-4 mt-5">Watches</h1>
  <hr class="mx-auto" />
  <h3 class="text-center mb-5">
    Explore our curated collection of watches that style and functionality.
  </h3>
  <div class="row">
    <?php include('database/get_watch.php') ?>
    <?php while ($watch = $watch_products->fetch_assoc()) { ?>
      <div class="one col-lg-3 col-md-6 col-sm-12 p-0">
        <img src="assests/images/<?php echo $watch['product_image']; ?>" alt="new" class="img-fluid" />
        <div class="detail">
          <h2><?php echo $watch['product_name']; ?></h2>
          <h4><?php echo $watch['product_price']; ?></h4>
          <a href="single_product.php?product_id=<?php echo $watch['product_id']; ?>"><button class="buy-btn">Buy Now</button></a>
        </div>
      </div>
    <?php } ?>
  </div>
</section>

<?php include('partial/footer.php') ?>