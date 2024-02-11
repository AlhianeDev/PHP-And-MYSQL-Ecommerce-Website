<?php 

  session_start();

  $connecte = false;

  if (isset($_SESSION["utilisateur"])) {

    $connecte = true;

  }

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

        <?php 
        
          if ($connecte) {

            ?>
              
              <li class="nav-item">

                <a class="nav-link <?= 
                
                  $_SERVER['PHP_SELF'] ===
                  
                  "/formation_pratique_ecommerce/ajouter_categorie.php" ?

                  "active" : null;
                  
                ?>" aria-current="page" href="ajouter_categorie.php">

                    Ajouter Catégorie

                </a>

              </li>

              <li class="nav-item">

                <a class="nav-link <?= 
                
                  $_SERVER['PHP_SELF'] ===
                  
                  "/formation_pratique_ecommerce/categories.php" ?

                  "active" : null;
                
                ?>" href="categories.php">List Des Catégories</a>

              </li>

              <li class="nav-item">

                <a class="nav-link <?= 
                  
                  $_SERVER['PHP_SELF'] ===
                  
                  "/formation_pratique_ecommerce/ajouter_produit.php" ?

                  "active" : null;
                
                ?>" href="ajouter_produit.php">Ajouter Produit</a>

              </li>

              <li class="nav-item">

                <a class="nav-link <?= 
                  
                  $_SERVER['PHP_SELF'] ===
                  
                  "/formation_pratique_ecommerce/produits.php" ?

                  "active" : null;
              
                ?>" href="produits.php">List Des Produits</a>

              </li>

              <li class="nav-item">

                <a class="nav-link <?= 
                  
                  $_SERVER['PHP_SELF'] ===
                  
                  "/formation_pratique_ecommerce/commande.php" ?

                  "active" : null;
              
                ?>" href="commande.php">Commandes</a>

              </li>

              <li class="nav-item">

                <a class="nav-link <?= 
                
                  $_SERVER['PHP_SELF'] ===
                  
                  "/formation_pratique_ecommerce/deconnexion.php" ?

                  "active" : null;
              
                ?>" href="deconnexion.php">Déconnexion</a>

              </li>
            
            <?php

          } else { ?> 
          
            <li class="nav-item">

              <a class="nav-link" aria-current="page" href="index.php">

                  Ajouter Utilisateur

              </a>

            </li>

            <li class="nav-item">

              <a class="nav-link" href="connexion.php">Connexion</a>

            </li>
          
          <?php }
        
        ?>

      </ul>

    </div>

  </div>

</nav>
