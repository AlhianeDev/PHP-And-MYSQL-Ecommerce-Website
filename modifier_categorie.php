<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>E-commerce - Modifier Catégorie</title>

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

        <h3 class="mb-4">Modifier Catégorie</h3>

        <?php

            if (!isset($_SESSION["utilisateur"])) {

                header("location: connexion.php");   

            }

            $sqlStatment = $pdo->prepare("SELECT * FROM categories WHERE id = ?");

            $sqlStatment->execute([$_GET["id"]]);

            $categorie = $sqlStatment->fetch(PDO::FETCH_ASSOC);

            $libelleErrorMsg = "";

            $descriptionErrorMsg = "";

            if (isset($_POST["modefierCategorie"])) {

                $id = htmlspecialchars($_POST["id"]);

                $libelle = htmlspecialchars(trim($_POST["libelle"]));

                $description = htmlspecialchars(trim($_POST["description"]));

                $icon = htmlspecialchars(trim($_POST["icon"]));

                if (empty($libelle)) {

                    $libelleErrorMsg = "Le Libelle est obligatoir *";
                    
                } 
                
                if (empty($description)) {

                    $descriptionErrorMsg = "La Description est obligatoir *";

                }

                if (!empty($libelle) && !empty($description)) {

                    $sqlStatment =$pdo->prepare(
                        
                        "UPDATE categories SET libelle = ?, description = ?,
                        
                        icon = ? WHERE id = ?"
                        
                    );

                    $result = $sqlStatment->execute([$libelle, $description, $icon, $id]);

                    if ($result) {

                        header("location: categories.php");

                    }

                }

            }
        
        ?>

        <form method="post">

            <input type="hidden" name="id" value="<?= $categorie["id"] ?>">

            <div class="mb-3">

                <label for="exampleInputLibelle" class="form-label">
                    
                    Libelle
            
                </label>

                <input 
                
                    type="text"
                    
                    class="form-control" 
                    
                    id="exampleInputLibelle" 

                    name="libelle"

                    value="<?= $categorie["libelle"] ?>"
                
                >

                <div class="form-text" style="color: red;">
                
                    <?= $libelleErrorMsg ?>
            
                </div>

            </div>

            <div class="mb-3">

                <label for="exampleInputDescription" class="form-label">Description</label>

                <input
                
                    type="text" 
                    
                    class="form-control" 
                    
                    id="exampleInputDescription"
                    
                    name="description" 

                    value="<?= $categorie["description"] ?>"
                
                >

                <div class="form-text" style="color: red;">
                
                    <?= $descriptionErrorMsg ?>
            
                </div>

            </div>

            <div class="mb-3">

                <label for="exampleInputIcon" class="form-label">Icon</label>

                <input
                
                    type="text" 
                    
                    class="form-control" 
                    
                    id="exampleInputIcon"
                    
                    name="icon" 

                    value="<?= $categorie["icon"] ?>"
                
                >

            </div>

            <button 
                
                type="submit"
                
                class="btn btn-primary"

                name="modefierCategorie"
            
            >Modifier Catégorie</button>

        </form>

    </div>

</body>

</html>
