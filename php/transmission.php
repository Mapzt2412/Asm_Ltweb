<?php
    if(isset($_GET["page"]) && $_GET["page"] == "product"){
      $_SESSION['idproduct'] = $_GET["id"];
      header("Location:product.php");
      }
    if(isset($_GET["page"]) && $_GET["page"] == "Manga"){
      $_SESSION['category'] = $_GET["page"];
      header("Location:productCategory.php");
    }
    if(isset($_GET["page"]) && $_GET["page"] == "Fanart"){
      $_SESSION['category'] = $_GET["page"];
      header("Location:productCategory.php");
    }
    if(isset($_GET["page"]) && $_GET["page"] == "cart"){
      header("Location:cart.php");
      }
      if(isset($_GET["search"])){
        $_SESSION['search'] = $_GET["search"];
        header("Location:/ASM/php/search.php");
      }
 ?>