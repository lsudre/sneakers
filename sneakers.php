<?php
require_once 'parts/header.php';
require_once 'parts/navbar.php';
require('func.php');
require('config/db.php');
?>
<body>
  <div class="container">
  <?php
  if ($_GET['brand'] == "Nike") {
    getCardByBrand("Nike");
  } else if ($_GET['brand'] == "Adidas") {
    getCardByBrand("Adidas");
  } else {
      // $countSneakers = getQuery("select count(sneakers.id) from dev.sneakers");
      // $nb = 1;
        getCardByBrand(null);
  }
     ?>
  </div>  
</body> 