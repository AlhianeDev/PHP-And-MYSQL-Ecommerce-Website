<!DOCTYPE html>

<?php 
            
    require_once "../includes/db.php";

    $sqlStatment = $pdo->prepare("SELECT * FROM categories WHERE id = ?");

    $sqlStatment->execute([$_GET["id"]]);

    $categorie = $sqlStatment->fetch(PDO::FETCH_OBJ);
        
?>

<html lang="en">

    <head>

        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Categories - <?= $categorie->libelle ?></title>

        <link
    
            rel="stylesheet" 
            
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" 
            
            integrity="sha512-10/jx2EXwxxWqCLX/hHth/vu2KY3jCF70dCQB8TSgNjbCVAC/8vai53GfMDrO2Emgwccf2pJqxct9ehpzG+MTw==" 
            
            crossorigin="anonymous" referrerpolicy="no-referrer" 
    
        />

        <link 
        
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
            
            rel="stylesheet" 
            
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
            
            crossorigin="anonymous"

        >

    </head>

    <body>

        <?php 

            require_once "../includes/db.php";
        
            include_once "../includes/nav_front.php";

            $sqlStatment = $pdo->prepare("SELECT * FROM produits WHERE id_categorie = ?");

            $sqlStatment->execute([$_GET["id"]]);

            $produits = $sqlStatment->fetchAll(PDO::FETCH_OBJ);
        
        ?>

        <div class="container my-5">

            <h4 class="mb-5">
                    
                <i class="<?= $categorie->icon ?>"></i> 
                
                <?= $categorie->libelle ?>
        
            </h4>

            <div class="row">

                <?php
                
                    if (!empty($produits)) {
                
                    foreach ($produits as $produit) { ?>

                        <div class="card mb-3 col-md-6">

                            <img

                                class="card-img-top"
                                
                                src="../uploads/<?= $produit->picture ?>" 

                                width="200" height="300"
                                
                                alt="Card image cap"

                            >

                            <div class="card-body">

                                <div class="row justify-content-between">

                                    <h5 class="card-title" style="width:fit-content">
                                        
                                        <?= $produit->libelle ?>
                                
                                    </h5>

                                    <span style="width:fit-content">
                                    
                                        <?= $produit->prix ?> MAD
                                
                                    </span>

                                </div>

                                <p class="card-text"><?= $produit->description ?></p>
                                
                                <p class="card-text"><small class="text-muted">

                                    <?= date_format(
                                        
                                        date_create($produit->date_creation), "Y/m/d"
                                        
                                    ) ?>

                                </small></p>

                            </div>

                            <div class="card-footer" style="padding: 15px;">

                                <?php include "../includes/front_includes/counter.php" ?>      

                                <hr>

                                <a 

                                    href="produit.php?id=<?= $produit->id ?>" 
                                    
                                    class="btn btn-primary stretched-link"

                                >Plus de détails</a>

                            </div>

                        </div>

                    <?php } } else { ?>

                        <div class="alert alert-info" role="alert">

                            Pas des produits pour l'instant

                        </div>

                    <?php }
                
                ?>

            </div>

        </div>

        <script src="../assets/js/counter.js"></script>
        
    </body>

</html>
