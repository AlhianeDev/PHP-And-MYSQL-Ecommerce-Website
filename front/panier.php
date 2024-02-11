<!DOCTYPE html>

<?php 
            
    require_once "../includes/db.php";
        
?>

<html lang="en">

    <head>

        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Panier</title>

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
        
            include_once "../includes/nav_front.php";

            $utilisateur_id = $_SESSION["utilisateur"]->id;

            $panier = $_SESSION["panier"][$utilisateur_id];

            if (!empty($panier)) {

                $productsIds = array_keys($panier);

                $implodedIds = implode(",", $productsIds);

                $produits = $pdo
                        
                ->query("SELECT * FROM produits Where id IN ($implodedIds)")
            
                ->fetchAll(PDO::FETCH_OBJ);
            
                if (isset($_POST["valider"])) {

                    $sql = "INSERT INTO 
                            
                    ligne_commande(id_produit, prix, quantity, total, id_commande) 
                    
                    VALUES";

                    $total = 0;

                    $for_ligne_commande = [];

                    foreach ($produits as $produit) {

                        $finalPrix = ($produit->prix - $produit->prix * $produit->discount / 100);

                        $total += $finalPrix * $panier[$produit->id];

                        $for_ligne_commande[$produit->id] = [

                            "id" => $produit->id,

                            "prix" => $finalPrix,

                            "quantity" => $panier[$produit->id],

                            "total" => $finalPrix * $panier[$produit->id]

                        ];

                    }

                    $date = date("Y-m-d H:i:s");

                    $sqlStatment = $pdo->prepare(
                        
                        "INSERT INTO commande(id_client, total, date_creation) VALUES(?, ?, ?)"
                    
                    );

                    $sqlStatment->execute([$utilisateur_id, $total, $date]);

                    $idCommande = $pdo->lastInsertId();

                    foreach ($for_ligne_commande as $ligne) {

                        $id = $ligne["id"];

                        $sql .= "(:id_produit$id, :prix$id, :quantity$id,
                        
                        :total$id, '$idCommande'),";

                    }

                    $sql = substr($sql, 0, -1);

                    $sqlStatment = $pdo->prepare($sql);

                    foreach ($for_ligne_commande as $ligne) {

                        $sqlStatment->bindParam(':id_produit'.$ligne["id"], $ligne["id"]);

                        $sqlStatment->bindParam(
                            
                            ':prix'.$ligne["id"],
                        
                            $ligne["prix"]
                    
                        );

                        $sqlStatment->bindParam(':quantity'.$ligne["id"], $ligne["quantity"]);

                        $sqlStatment->bindParam(
                            
                            ':total'.$ligne["id"],
                        
                            $ligne["total"]
                    
                        );

                    }

                    $isiserted = $sqlStatment->execute();

                    if ($isiserted) {

                        $_SESSION["panier"][$utilisateur_id] = [];

                        header("location: panier.php");

                    }

                }
        
        ?>

        <div class="container my-5">

            <h4 class="mb-5">Panier (<?= PRODUCTS_COUNT ?>)</h4>

            <div class="row gap-4">

                            <table class="table">

                                <thead>

                                    <tr>

                                    <th scope="col">#</th>

                                    <th scope="col">Image</th>

                                    <th scope="col">Libelle</th>

                                    <th scope="col">Quantité</th>

                                    <th scope="col">Prix</th>

                                    <th scope="col">Total</th>

                                    </tr>

                                </thead>

                                <tbody>

                                    <?php 
                                    
                                        $total = 0;
                                    
                                        foreach ($produits as $produit) { 
                                            
                                            $total += ($produit->prix - $produit->prix * $produit->discount / 100) * $panier[$produit->id];
                                        
                                        ?>

                                            <tr>

                                            <td><?= $produit->id ?></td>

                                            <td>
                                                
                                                <img src="../uploads/<?= 
                                                
                                                    $produit->picture
                                                
                                                ?>" alt="Produits Photo!" width="80px">
                                            
                                            </td>

                                            <td><?= $produit->libelle ?></td>

                                            <td><?php

                                                include "../includes/front_includes/counter.php";

                                            ?></td>

                                            <td><?= $produit->prix - $produit->prix * $produit->discount / 100 ?> MAD</td>

                                            <td><?= ($produit->prix - $produit->prix * $produit->discount / 100) * $panier[$produit->id] ?> MAD</td>
                                            
                                            </tr>

                                        <?php }
                                    
                                    ?>

                                </tbody>

                                <tfoot>

                                    <tr>

                                        <td colspan="5" align="right">Total: </td>

                                        <td><?= $total ?> MAD</td>

                                    </tr>

                                    <tr>

                                        <td  colspan="6" align="right">

                                            <?php 
                                            
                                                if (isset($_POST["vider"])) {

                                                    $_SESSION["panier"][$utilisateur_id] = [];

                                                    header("location: panier.php");

                                                }
                                            
                                            ?>

                                            <form method="post">

                                                <input
                                                
                                                    type="submit"

                                                    value="Valider la commande"
                                                    
                                                    name="valider"

                                                    class="btn btn-success"
                                                
                                                >

                                                <input 
                                                
                                                    type="submit" 

                                                    value="Vider le panier"
                                                    
                                                    name="vider"

                                                    class="btn btn-danger"
                                                
                                                >

                                            </form>

                                        </td>

                                    </tr>

                                </tfoot>

                            </table>

                        <?php
                
                    } else { ?>

                        <div class="alert alert-info" role="alert">

                            Votre Panier Est Vide!

                        </div>

                    <?php }

                ?>

            </div>

        </div>

        <script src="../assets/js/counter.js"></script>
        
    </body>

</html>
