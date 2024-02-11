<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>E-commerce - Liste des catégories</title>

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

        <?php include_once "../includes/nav_front.php" ?>

        <div class="container my-5">

            <?php 
            
                require_once "../includes/db.php";

                $categories = $pdo->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);
            
            ?>

            <ul class="list-group">

                <?php 
                
                    foreach ($categories as $category) { ?>

                        <li class="list-group-item">

                            <a href="categorie.php?id=<?= $category["id"] ?>">

                                <i class="<?= $category["icon"] ?>"></i> 

                                <?= $category["libelle"] ?>
                        
                            </a>

                        </li>

                    <?php }
                
                ?>


            </ul>

        </div>
        
    </body>

</html>