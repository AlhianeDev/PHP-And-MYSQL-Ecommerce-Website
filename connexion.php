<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>E-commerce - Connexion</title>

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
    
        include_once "./includes/header.php" 
    
    ?>

    <div class="container py-5">

        <h3 class="mb-4">Connexion</h3>

        <?php

            $usernameErrorMsg = "";

            $passwordErrorMsg = "";

            if (isset($_POST["connexion"])) {

                $username = htmlspecialchars(trim($_POST["username"]));

                $password = htmlspecialchars(trim($_POST["password"]));

                if (empty($username)) {

                    $usernameErrorMsg = "Nom d'utilisateur est obligatoir*";
                    
                } 
                
                if (empty($password)) {

                    $passwordErrorMsg = "Le mot de passe est obligatoir*";

                }

                if (!empty($username) && !empty($password)) {

                    $sqlStatment =$pdo->prepare(
                        
                        "SELECT * FROM utilisateurs WHERE username=? && password=?"
                        
                    );

                    $sqlStatment->execute([$username, $password]);

                    if ($sqlStatment->rowCount() > 0) {

                        $_SESSION["utilisateur"] = $sqlStatment->fetch(PDO::FETCH_OBJ);

                        header("location: admin.php");

                    } else { ?> 
                    
                        <div class="alert alert-danger" role="alert">

                            Le nom d'utilisateur ou password est incorrect!

                        </div>
                        
                    <?php }

                }

            }
        
        ?>

        <form method="post">

            <div class="mb-3">

                <label for="exampleInputUsername1" class="form-label">
                    
                    Nom D'utilisateur
            
                </label>

                <input 
                
                    type="text"
                    
                    class="form-control" 
                    
                    id="exampleInputUsername1" 

                    name="username"
                
                >

                <div class="form-text" style="color: red;">
                
                    <?= $usernameErrorMsg ?>
            
                </div>

            </div>

            <div class="mb-3">

                <label for="exampleInputPassword1" class="form-label">Mot De Passe</label>

                <input
                
                    type="password" 
                    
                    class="form-control" 
                    
                    id="exampleInputPassword1"
                    
                    name="password" 
                
                >

                <div class="form-text" style="color: red;">
                
                    <?= $passwordErrorMsg ?>
            
                </div>

            </div>

            <button 
                
                type="submit"
                
                class="btn btn-primary"

                name="connexion"
            
            >Connexion</button>

        </form>

    </div>

</body>

</html>
