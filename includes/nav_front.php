<?php 

  session_start();

  $connecte = false;

  if (isset($_SESSION["utilisateur"])) {

    $connecte = true;

  }
  
  define(
    
    "PRODUCTS_COUNT", 

    isset($_SESSION["panier"]) && $_SESSION["panier"][$_SESSION["utilisateur"]->id] ?

    count($_SESSION["panier"][$_SESSION["utilisateur"]->id]) : 0

  );

?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">

  <div class="container-fluid">

    <a class="navbar-brand" href="#">E-commerce</a>

    <button 
    
        class="navbar-toggler"
        
        type="button" 
        
        data-bs-toggle="collapse"
        
        data-bs-target="#navbarNav"
        
        aria-controls="navbarNav" 
        
        aria-expanded="false" 
        
        aria-label="Toggle navigation"
    
    >

      <span class="navbar-toggler-icon"></span>

    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">

      <ul class="navbar-nav">

        <li class="nav-item">

          <a class="nav-link" aria-current="page" href="../front/index.php">

              List des categories

          </a>

        </li>

        <li class="nav-item">

          <a class="nav-link" aria-current="page" href="../front/panier.php">

            <i class="fa-solid fa-cart-shopping"></i> Panier (<?= PRODUCTS_COUNT ?>)

          </a>

        </li>

      </ul>

    </div>

  </div>

</nav>
