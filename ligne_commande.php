<?php 

    require_once "./includes/db.php";

    $sqlStatment = $pdo
                        
    ->prepare("SELECT commande.*, utilisateurs.username as username

    FROM commande INNER JOIN utilisateurs 

    ON commande.id_client = utilisateurs.id

    WHERE commande.id = ?

    ORDER BY commande.date_creation DESC");

    $sqlStatment->execute([$_GET["id"]]);

    $commandes = $sqlStatment->fetchAll(PDO::FETCH_OBJ);

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Ligne Commande | Numéro <?= $_GET["id"] ?></title>

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
    
        include_once "./includes/header.php";

        if (!isset($_SESSION["utilisateur"])) {

            header("location: connexion.php");   
    
        }
    
    ?>

    <div class="container py-5">

        <table class="table table-striped">

            <thead>

                <tr>

                    <th>#Id</th>

                    <th>Client</th>
                    
                    <th>Total</th>

                    <th>Date</th>

                    <th>Opérations</th>

                </tr>

            </thead>

            <tbody>

                <?php

                    if (sizeof($commandes) <= 0) { ?>

                        <tr><td colspan="5" class="text-center">
                            
                            Aucune commandes à afficher !
                    
                        </td></tr>

                    <?php } else {

                    foreach ($commandes as $commande) { ?> 

                        <tr>

                            <td><?= $commande->id ?></td>

                            <td><?= $commande->username ?></td>

                            <td><?= $commande->total ?> MAD</td>

                            <td><?= $commande->date_creation ?></td>

                            <td>

                                <?php if ($commande->valider === 0) { ?>
                                    
                                    <a class="btn btn-success" 
                                    
                                    href="valider.php?id=<?= 
                                    
                                    $commande->id ?>&etat=1"
                                    
                                    >Valider La Commande</a>
                                    
                                <?php } else { ?>
                                
                                    <a class="btn btn-danger"

                                    href="valider.php?id=<?= 
                                    
                                    $commande->id ?>&etat=0"
                                        
                                    >Anuller La Commande</a>
                                    
                                <?php } ?>

                            </td>

                        </tr>                        
                        
                    <?php } }
                
                ?>

            </tbody>

        </table>

        <hr class="my-4">

        <table class="table table-striped">

            <thead>

                <tr>

                    <th>#Id</th>

                    <th>Produit</th>
                    
                    <th>Image</th>

                    <th>Prix Unitaire</th>

                    <th>Quantity</th>

                    <th>Total</th>

                </tr>

            </thead>

            <tbody>

                <?php

                    $sqlStatmentLigneCommande = $pdo->prepare("SELECT ligne_commande.*,
                    
                    produits.libelle, produits.picture
                    
                    FROM ligne_commande 
                    
                    INNER JOIN produits ON ligne_commande.id_produit = produits.id 
                    
                    WHERE id_commande = ?");

                    $sqlStatmentLigneCommande->execute([$_GET["id"]]);

                    $ligneCommandes = $sqlStatmentLigneCommande->fetchAll(PDO::FETCH_OBJ);

                    foreach ($ligneCommandes as $ligneCommande) { ?> 

                        <tr>

                            <td><?= $ligneCommande->id ?></td>

                            <td><?= $ligneCommande->libelle ?></td>

                            <td>
                                
                                <img 
                                
                                    src="./uploads/<?= $ligneCommande->picture ?>" 
                                    
                                    alt="..."
                                    
                                    width="80"
                                
                                >
                        
                            </td>

                            <td><?= $ligneCommande->prix ?> MAD</td>

                            <td><?= $ligneCommande->quantity ?></td>

                            <td><?= $ligneCommande->total ?> MAD</td>

                        </tr>                        
                        
                    <?php }
                
                ?>

            </tbody>

        </table>

    </div>

</body>

</html>
