<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>E-commerce - List Des Catégories</title>

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

                    <th>#Id</th>

                    <th>Client</th>
                    
                    <th>Total</th>

                    <th>Date</th>

                    <th>Opérations</th>

                </tr>

            </thead>

            <tbody>

                <?php

                    $commandes = $pdo
                    
                        ->query("SELECT commande.*, utilisateurs.username as username
                        
                        FROM commande INNER JOIN utilisateurs 
                        
                        ON commande.id_client = utilisateurs.id
                        
                        ORDER BY commande.date_creation DESC")
                        
                        ->fetchAll(PDO::FETCH_OBJ);

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

                                <a class="btn btn-primary"
                                
                                    href="ligne_commande.php?id=<?= $commande->id ?>"
                                    
                                >Plus De Détails</a>

                            </td>

                        </tr>                        
                        
                    <?php } }
                
                ?>

            </tbody>

        </table>

    </div>

</body>

</html>
