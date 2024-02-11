<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>E-commerce - Ajouter Produit</title>

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
    
    ?>

    <div class="container py-5">

        <h3 class="mb-4">Ajouter Produit</h3>

        <?php

            if (!isset($_SESSION["utilisateur"])) {

                header("location: connexion.php");   

            }

            $libelleErrorMsg = "";

            $prixErrorMsg = "";

            $categorieErrorMsg = "";

            if (isset($_POST["ajouterProduit"])) {

                $image = "produit.jpg";

                if (!empty($_FILES["image"]["name"])) {

                    $image = uniqid() . $_FILES["image"]["name"];

                    move_uploaded_file(
                        
                        $_FILES["image"]["tmp_name"], "./uploads/".$image
                    
                    );

                }

                $libelle = htmlspecialchars(trim($_POST["libelle"]));

                $prix = htmlspecialchars(trim($_POST["prix"]));

                $discount = htmlspecialchars(trim($_POST["discount"]));

                $categorie = htmlspecialchars(trim($_POST["categorie"]));

                $description = htmlspecialchars(trim($_POST["description"]));

                if (empty($libelle)) {

                    $libelleErrorMsg = "Le Libelle est obligatoir *";
                    
                } 
                
                if (empty($prix)) {

                    $prixErrorMsg = "Le Prix est obligatoir *";

                }

                if (empty($categorie)) {

                    $categorieErrorMsg = "La Categorie est obligatoir *";

                }

                if (!empty($libelle) && !empty($prix) && !empty($categorie)) {
                    
                    $date = date("Y-m-d H:i:s");

                    $sqlStatment =$pdo->prepare(
                        
                        "INSERT INTO produits VALUES (null, ?, ?, ?, ?, ?, ?, ?)"
                        
                    );

                    $result = $sqlStatment->execute(
                        
                        [$libelle, $prix, $discount, $categorie, $date, $image, $description]
                    
                    );

                    if ($result) {

                        header("location: produits.php");

                    }

                }

            }
        
        ?>

        <form method="post" enctype="multipart/form-data">

            <div class="mb-3">

                <label for="exampleInputLibelle" class="form-label">
                    
                    Libelle

                </label>

                <input 
                
                    type="text"
                    
                    class="form-control" 
                    
                    id="exampleInputLibelle" 

                    name="libelle"
                
                >

                <div class="form-text" style="color: red;">
                
                    <?= $libelleErrorMsg ?>
            
                </div>

            </div>

            <div class="mb-3">

                <label for="exampleInputPic" class="form-label">Produit Picture</label>

                <input
                
                    type="file" 
                    
                    class="form-control" 
                    
                    id="exampleInputPic"
                    
                    name="image"
                
                >

            </div>

            <div class="mb-3">

                <label for="exampleInputDesc" class="form-label">Description</label>

                <textarea
                    
                    class="form-control" 
                    
                    id="exampleInputDesc"
                    
                    name="description"
                
                ></textarea>

            </div>

            <div class="mb-3">

                <label for="exampleInputPrix" class="form-label">Prix</label>

                <input
                
                    type="number" 
                    
                    class="form-control" 
                    
                    id="exampleInputPrix"

                    min="0"

                    step="0.1"
                    
                    name="prix" 
                
                >

                <div class="form-text" style="color: red;">
                
                    <?= $prixErrorMsg ?>
            
                </div>

            </div>

            <div class="mb-3">

                <label for="exampleInputDiscount" class="form-label">Discount</label>

                <input
                
                    type="range" 
                    
                    class="form-control" 
                    
                    id="exampleInputDiscount"

                    min="0"

                    max="90"

                    step="10"
                    
                    name="discount" 
                
                >

            </div>

            <div class="mb-3">

                <label for="exampleInputCatégorie" class="form-label">Catégorie</label>

                <select
                    
                    class="form-control" 
                    
                    id="exampleInputCatégorie"
                    
                    name="categorie"
                
                >
            
                    <option value="">Choisissez une catégorie</option>

                    <?php 
                    
                        $categories = $pdo
                        
                            ->query("SELECT * FROM categories")
                            
                            ->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($categories as $categorie) { ?>

                            <option value="<?= $categorie["id"] ?>">
                        
                                <?= $categorie["libelle"] ?>

                            </option>
  
                        <?php }
                    
                    ?>
            
                </select>

                <div class="form-text" style="color: red;">
                
                    <?= $categorieErrorMsg ?>
            
                </div>

            </div>

            <button 
                
                type="submit"
                
                class="btn btn-primary"

                name="ajouterProduit"
            
            >Ajouter Produit</button>

        </form>

    </div>

</body>

</html>
