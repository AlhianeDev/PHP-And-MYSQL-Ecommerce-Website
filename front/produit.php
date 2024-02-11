<!DOCTYPE html>

<?php 
            
    require_once "../includes/db.php";

    include_once "../includes/nav_front.php";

    $sqlStatment = $pdo->prepare("SELECT * FROM produits WHERE id = ?");

    $sqlStatment->execute([$_GET["id"]]);

    $produit = $sqlStatment->fetch(PDO::FETCH_OBJ);
        
?>

<html lang="en">

    <head>

        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Produit - <?= $produit->libelle ?></title>

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

        <div class="container my-5">

            <h4 class="mb-5"><?= $produit->libelle ?></h4>

            <div class="row">

                <div class="col-md-6">

                    <img src="../uploads/<?= $produit->picture ?>" alt="" class="img-fluid w-75">

                </div>

                <div class="col-md-6">

                    <h3><?= $produit->libelle ?></h3>

                    <hr>

                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <?php if ($produit->discount > 0) { ?>

                            <h4><strike><?= $produit->prix ?> MAD</strike></h4>

                            <span class="btn btn-success">-<?= $produit->discount ?>%</span>

                            <h4>
                                    
                                <?=
                                
                                $produit->prix - ($produit->prix  * $produit->discount) / 100
                                    
                                ?>
                                
                                MAD
                            
                            </h4>

                        <?php } else { ?>

                            <h4><?= $produit->prix ?> MAD</h4>

                        <?php } ?>

                    </div>

                    <hr>

                    <p class="mb-3"><?= $produit->description ?></p>

                    <hr>

                    <div class="d-flex justify-content-between mb-3">

                        <span>
                            
                            <?= date_format(date_create($produit->date_creation),
                            
                            "Y - m - d") ?>
                    
                        </span>

                        <span>
                        
                            <?= date_format(date_create($produit->date_creation),
                            
                            "h : m : s") ?>
                
                        </span>

                    </div>

                    <hr>

                    <?php include "../includes/front_includes/counter.php" ?>
 
                </div>

            </div>

        </div>

        <script src="../assets/js/counter.js"></script>
        
    </body>

</html>
