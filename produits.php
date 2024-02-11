<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>E-commerce - List Des Produits</title>

    <link 
    
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
        
        rel="stylesheet" 
        
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" 
        
        crossorigin="anonymous"

    >

</head>

<body>
    
    <?php

        require_once "./includes/db.php";
    
        include_once "./includes/header.php";
        
        if (!isset($_SESSION["utilisateur"])) {

            header("location: connexion.php");   
    
        }
        
    ?>

    <div class="container py-5">

        <table class="table table-striped">

            <thead>

                <tr>

                    <th>Id</th>

                    <th>Libelle</th>

                    <th>Prix</th>

                    <th>Prix Finale</th>

                    <th>Catégorie</th>

                    <th>Date De Creation</th>

                    <th>Opérations</th>

                </tr>

            </thead>

            <tbody>

                <?php

                    $produits = $pdo
                    
                        ->query(
                            
                            "SELECT produits.*, categories.libelle as categorie_libelle
                            
                            FROM produits INNER JOIN categories
                            
                            ON produits.id_categorie = categories.id"
                            
                        )->fetchAll(PDO::FETCH_ASSOC);

                    if (sizeof($produits) <= 0) { ?>

                        <tr><td colspan="7" class="text-center">
                            
                            Aucune produits à afficher !
                    
                        </td></tr>

                    <?php } else {

                    foreach ($produits as $produit) { ?> 

                        <tr>

                            <td><?= $produit["id"] ?></td>

                            <td><?= $produit["libelle"] ?></td>

                            <td><?= $produit["prix"] ?> MAD</td>

                            <td><?= 
                            
                                $produit["prix"] - $produit["prix"] * $produit["discount"] / 100 
                            
                            ?> MAD</td>

                            <td><?= $produit["categorie_libelle"] ?></td>

                            <td><?= $produit["date_creation"] ?></td>

                            <td>

                                <a class="btn btn-success"
                                
                                    href="modifier_produit.php?id=<?= $produit["id"] ?>"
                                    
                                >Modifier</a>

                                <a class="btn btn-danger"
                                
                                    href="supprimer_produit.php?id=<?= $produit["id"] ?>"

                                    onclick="return confirm('Voulez vous vraiment ' +
                                    
                                    'supprimer le produit <?= $produit['libelle'] ?>?');"
                                
                                >Supprimer</a>

                            </td>

                        </tr>                        
                        
                    <?php } }
                
                ?>

            </tbody>

        </table>

    </div>

</body>

</html>
