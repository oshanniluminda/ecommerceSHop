<?php

include('database/connect.php');

if (isset($_GET['product_id'])) {

  $product_id = $_GET['product_id'];

  $stmt = $conn->prepare("SELECT * FROM products where product_id = ?");

  $stmt->bind_param("i", $product_id);

  $stmt->execute();

  $products = $stmt->get_result();
}
// }else{

//   header('Location: index.php');

// }

?>

<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Fashioner</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

  <link rel="stylesheet" href="assests/css/style.css" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>

<body>

  <nav class="navbar navbar-expand-lg bg-body-tertiary py-2 fixed-top mb-5">
    <div class="container">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 nav-buttons">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Shop</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Blog</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact Us</a>
          </li>
          <li class="nav-item">
            <i class="fas fa-shopping-cart"></i>
            <i class="fas fa-user"></i>
          </li>
        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
          <button class="btn btn-outline-success" type="submit">
            Search
          </button>
        </form>
      </div>
    </div>
  </nav>

  <section class="single-product container my-5 pt-5">
    <div class="row mt-5">

      <?php while ($product=$products->fetch_assoc()) { ?>

        <div class="col-lg-5 col-md-6 col-sm-12">
          <img src="assests/images/<?php echo $product['product_image']; ?>" class="img-fluid w-100 pb-1" alt="" id="mainImg" />
          <div class="small-img-group">
            <div class="small-img-col">
              <img src="assests/images/watch.png" width="100%" class="small-img" alt="" />
            </div>
            <div class="small-img-col">
              <img src="assests/images/shoe.png" width="100%" class="small-img" alt="" />
            </div>
            <div class="small-img-col">
              <img src="assests/images/t shirt.png" width="100%" class="small-img" alt="" />
            </div>
            <div class="small-img-col">
              <img src="assests/images/watch.png" width="100%" class="small-img" alt="" />
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12">
          <h6><?php echo $product['product_category']; ?></h6>
          <h3 class="py-3"><?php echo $product['product_name']; ?></h3>
          <h4 class="py-3">$<?php echo $product['product_price']; ?></h4>


          <form action="cart.php" method="post">
            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $product['product_image']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $product['product_price']; ?>">
            <input type="hidden" name="product_name" value="<?php echo $product['product_name']; ?>">
            <input type="number" name="product_quantity" value="1">
            <button class="btn btn-primary" type="submit" name="submit">Add to Cart</button>
          </form>

          <h3 class="py-3">Product Details <i class="fas fa-indent"></i></h3>
          <p><?php echo $product['product_description']; ?></p>
        </div>

      <?php } ?>
    </div>
  </section>

  <section id="sell" class="w-100 py-5 mt-5 container">
    <h1 class="text-center mb-4">Related Products</h1>
    <hr class="mx-auto" />

    <div class="row">
      <div class="one col-lg-3 col-md-6 col-sm-12 p-0">
        <img src="assests/images/shoe.png" alt="new" class="img-fluid" />
        <div class="detail">
          <h2>Shoes</h2>
          <h4>$99.99</h4>
          <button class="buy-btn">Buy Now</button>
        </div>
      </div>
      <div class="one col-lg-3 col-md-6 col-sm-12 p-0">
        <img src="assests/images/t shirt.png" alt="new" class="img-fluid" />
        <div class="detail">
          <h2>Shirts</h2>
          <h4>$49.99</h4>
          <button class="buy-btn">Buy Now</button>
        </div>
      </div>
      <div class="one col-lg-3 col-md-6 col-sm-12 p-0">
        <img src="assests/images/blazer.png" alt="new" class="img-fluid" />
        <div class="detail">
          <h2>Blazer</h2>
          <h4>$199.99</h4>
          <button class="buy-btn">Buy Now</button>
        </div>
      </div>
      <div class="one col-lg-3 col-md-6 col-sm-12 p-0">
        <img src="assests/images/watch.png" alt="new" class="img-fluid" />
        <div class="detail">
          <h2>Watch</h2>
          <h4>$79.99</h4>
          <button class="buy-btn">Buy Now</button>
        </div>
      </div>
    </div>


    <!-- <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
              <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#">1</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#">2</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#">3</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                </a>
              </li>
            </ul>
          </nav> -->

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

  <!-- <script>
        const smallImg = document.querySelectorAll('.small-img');
        const mainImg = document.getElementById('mainImg');

        smallImg.forEach((img) => {
            img.addEventListener('click', () => {
                mainImg.src = img.src;
            });
        });
    </script> -->

  <script>
    var mainImg = document.getElementById('mainImg');
    var smallImg = document.getElementsByClassName('small-img');



    for (let i = 0; i < 4; i++) {
      smallImg[i].onclick = function() {
        mainImg.src = smallImg[i].src;
      }
    }
  </script>
</body>

</html>