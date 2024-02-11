<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>E-commerce - Ajouter Catégorie</title>

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

        <h3 class="mb-4">Ajouter Catégorie</h3>

        <?php

            if (!isset($_SESSION["utilisateur"])) {

                header("location: connexion.php");   

            }

            $libelleErrorMsg = "";

            $descriptionErrorMsg = "";

            if (isset($_POST["ajouterCategorie"])) {

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
                    
                    $date = date("Y-m-d H:i:s");

                    $sqlStatment =$pdo->prepare(
                        
                        "INSERT INTO categories VALUES (null, ?, ?, ?, ?)"
                        
                    );

                    $result = $sqlStatment->execute([$libelle, $description, $date, $icon]);

                    header("location: categories.php");

                }

            }
        
        ?>

        <form method="post">

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

                <label for="exampleInputDescription" class="form-label">Description</label>

                <input
                
                    type="text" 
                    
                    class="form-control" 
                    
                    id="exampleInputDescription"
                    
                    name="description" 
                
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
                
                >

            </div>

            <button 
                
                type="submit"
                
                class="btn btn-primary"

                name="ajouterCategorie"
            
            >Ajouter Catégorie</button>

        </form>

    </div>

</body>

</html>
