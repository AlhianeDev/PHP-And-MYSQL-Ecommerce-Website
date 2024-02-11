<form 

    method="post"

    action="ajouter_au_panier.php"
    
    class="d-flex quantity" 
    
    style="position: relative; z-index: 10"
    
>

    <input type="hidden" name="id" value="<?= $produit->id ?>">

    <button 
    
        onclick="return false;"
        
        type="button"
        
        id="minusQuantity"
        
        class="btn btn-primary minus"

        data-className="quantityInput<?= $produit->id ?>"
    
    >
    
        -

    </button>

    <input 
    
        type="number"
        
        id="quantityNumber"

        name="quantity"

        value="<?php
        
            if (isset($_SESSION["panier"][$_SESSION["utilisateur"]->id][$produit->id])) {

                echo $_SESSION["panier"][$_SESSION["utilisateur"]->id][$produit->id];

            } else {

                echo "0";

            }

        ?>"

        class="form-control mx-2 quantityInput<?= $produit->id ?>"

        min="0" max="99"
        
        style="width: 80px;"
    
    >

    <button 
    
        onclick="return false;"
        
        type="button" 
        
        id="addQuantity" 
        
        class="btn btn-primary add"

        data-className="quantityInput<?= $produit->id ?>"
    
    >
    
        +
    
    </button>

    <input 
    
        type="submit" 
        
        value="<?= 
        
            isset($_SESSION["panier"][$_SESSION["utilisateur"]->id][$produit->id]) ?
            
            ( $_SESSION["panier"][$_SESSION["utilisateur"]->id][$produit->id] > 0 ?
            
            "Modifier" : "Ajouter" ) : "Ajouter"
        
        ?>"
        
        class="btn btn-primary mx-2"
    
    >

    <?php 

    if (isset($_SESSION["panier"][$_SESSION["utilisateur"]->id][$produit->id])) {
    
        if ($_SESSION["panier"][$_SESSION["utilisateur"]->id][$produit->id] > 0) { ?>

            <input
                
                type="submit"
                
                value="Suprimmer"
                
                formaction="suprimmer_au_panier.php"
                
                class="btn btn-danger"
            
            >

        <?php }

    }
    
    ?>

</form>
