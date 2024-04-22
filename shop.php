<?php

include('database/connect.php');


if (isset($_POST['search'])) {

  if(isset($_GET['page_no']) && $_GET['page_no'] != ""){
    $page_no = $_GET['page_no'];
  }else{
    $page_no = 1;
  }


  $category = $_POST['category'];
  $price = $_POST['price'];

  $stmt1 = $conn->prepare("SELECT COUNT(*) as total_record FROM products WHERE product_category = ? AND product_price <= ?");
  $stmt1->bind_param("si", $category, $price);
  $stmt1->execute();
  $stmt1->bind_result($total_record);
  $stmt1->store_result();
  $stmt1->fetch();

  $total_record_per_page = 1;

  $off = ($page_no - 1) * $total_record_per_page;

  $prev = $page_no - 1;
  $next = $page_no + 1;

  $addjacents = 4;

  $total_no_of_page = ceil($total_record / $total_record_per_page);

  $stmt2 = $conn->prepare("SELECT * FROM products WHERE product_category = ? AND product_price <= ?  LIMIT $off, $total_record_per_page");
  $stmt2->bind_param("si", $category, $price);
  $stmt2->execute();
  $products = $stmt2->get_result(); 

} else {
  // Get the product id
  // $stmt = $conn->prepare("SELECT * FROM products");

  // $stmt->execute();

  // $products = $stmt->get_result();

  if(isset($_GET['page_no']) && $_GET['page_no'] != ""){
    $page_no = $_GET['page_no'];
  }else{
    $page_no = 1;
  }
  $stmt1 = $conn->prepare("SELECT COUNT(*) as total_record FROM products");
  $stmt1->execute();
  $stmt1->bind_result($total_record);
  $stmt1->store_result();
  $stmt1->fetch();


  $total_record_per_page = 1;

  $off = ($page_no - 1) * $total_record_per_page;

  $prev = $page_no - 1;
  $next = $page_no + 1;

  $addjacents = 4;

  $total_no_of_page = ceil($total_record / $total_record_per_page);


  $stmt2 = $conn->prepare("SELECT * FROM products LIMIT $off, $total_record_per_page");
  $stmt2->execute();
  $products = $stmt2->get_result(); 
}

?>


<?php include('partial/header.php') ?>

<section class="main-container m-5">

  <section id="search" class="my-5 py-5">
    <div class="container ">
      <p>search Products</p>
      <hr>
    </div>
    <form action="shop.php" method="post">
      <div class="row container mx-auto">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <p>Category</p>
          <div class="form-check">
            <input class="form-check-input" value="shoes" type="radio" name="category" id="category-one">
            <label class="form-check-label" for="category-one">Shoes</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" value="watches" type="radio" name="category" id="category-two">
            <label class="form-check-label" for="category-two">Watches</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" value="men" type="radio" name="category" id="category-three">
            <label class="form-check-label" for="category-three">Men</label>
          </div>
          <div class="form-check">
            <input class="form-check-input" value="women" type="radio" name="category" id="category-four">
            <label class="form-check-label" for="category-four">Women</label>
          </div>
        </div>
      </div>

      <div class="row container mx-auto mt-5">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <p>Price</p>
          <input type="range" class="form-range w-50" name="price" value="199.00" min="1" max="1000" id="customRange2">
          <div class="w-100">
            <span class="float-left;">$1</span>
            <span class="float-right;">$1000</span>
          </div>
        </div>
      </div>

      <div class="form-group mx-auto my-3 mx-3">
        <button type="submit" name="search" class="btn btn-primary">Search</button>
      </div>
    </form>
  </section>

  <section id="sell" class="w-100 py-5 mt-5 container">

    <h3 class="text-center">Hurry Up, Grab your valubale oppurtunity</h3>
    <div class="row">

      <?php while ($product = $products->fetch_assoc()) { ?>

        <div onclick="window.location.href = 'single_product.php';" class="one col-lg-3 col-md-6 col-sm-12 p-0">
          <img src="assests/images/<?php echo $product['product_image']; ?>" alt="new" class="img-fluid" />
          <div class="detail">
            <h2><?php echo $product['product_name']; ?></h2>
            <h4><?php echo $product['product_price']; ?></h4>
            <button class="buy-btn"><a href="single_product.php?product_id=<?php echo $product['product_id']; ?>">Buy Now</a></button>
          </div>
        </div>

      <?php } ?>


    </div>


    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center">
        <li class="page-item <?php if($page_no<=1){echo 'disabled';} ?>">
          <a class="page-link" href="<?php if($page_no <= 1){echo '#';}else{echo "?page_no=".$page_no-1;}?>" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>
        <li class="page-item">
          <a class="page-link" href="?page_no=1">1</a>
        </li>
        <li class="page-item">
          <a class="page-link" href="?page_no=2">2</a>
        </li>
       

        <?php if($page_no>=3){ ?>
        <li class="page-item">
          <a class="page-link" href="#">...</a>
          <a class="page-link" href="<?php echo "?page_no=".$page_no;?>"><?php echo $page_no; ?></a>
        </li>
        <?php } ?>

        <li class="page-item <?php if($page_no>=$total_no_of_page){echo 'disabled';} ?>">
          <a class="page-link" href="<?php if($page_no >=$total_no_of_page ){echo '#';}else{echo "?page_no=".$page_no+1;}?>"
 aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
      </ul>
    </nav>

  </section>
</section>

<footer class="mt-5 py-5 container-fluid">
  <div class="row ">
    <div class="footer-one col-lg-3 col-md-6 col-sm-12">
      <img src="assests/images/quality.png" alt="" />
      <p>Get the best quality products at the best price</p>
    </div>
    <div class="footer-one col-lg-3 col-md-6 col-sm-12">
      <h5 class="pb-2">Feature</h5>
      <ul class="text-uppercase">
        <li><a href="">Men</a></li>
        <li><a href="">Women</a></li>
        <li><a href="">Clothes</a></li>
        <li><a href="">Watch</a></li>
        <li><a href="">Shoes</a></li>
      </ul>
    </div>

    <div class="footer-one col-lg-3 col-md-6 col-sm-12">
      <h5 class="pb-2">Contact Us</h5>
      <div>
        <i class="fas fa-map-marker-alt"></i>
        <p>123, Main Road, New City, USA</p>
      </div>

      <div>
        <i class="fas fa-envelope"></i>
        <p>info@gmail.com</p>
      </div>

      <div>
        <i class="fas fa-phone-alt"></i>
        <p>+94769225132</p>
      </div>
    </div>

    <div class="footer-one col-lg-3 col-md-6 col-sm-12">
      <h5 class="pb-2">Newsletter</h5>
      <p>Subscribe to our newsletter and get 20% off your first purchase</p>
      <form action="">
        <input type="email" placeholder="Enter your email" />
        <button type="submit" name="submit">Subscribe</button>
      </form>
    </div>
  </div>

  <div class="mt-5">
    <p class="text-center">
      &copy; 2024 Fashioner | Designed by <a href="">Oshan</a>
    </p>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>