<?php

namespace Browser;

class Liste
{
    function generateliste($cb): void
    { ?>

        <div id="filtres">

            <div id="filtre_ingredients">

                    <input id="search_ingredient" type="text" placeholder="Quels ingrédients" name="ingredient">

                    <div id="checkbox_ingredient">
                        <?php $dataIngr = $cb->getAllIngredients();
                        $idRecette = null;
                        if(isset($_GET["idRecette"])){
                            $idRecette = $_GET["idRecette"];
                        }
                            $dataQte = $cb->getIngrQuantities($idRecette);
                        ?>
                        
                    </div>


            </div>

            <div id="filtre_tags">

                    <input id="search_tag" type="text" placeholder="Quels tags">

                    <div id="checkbox_tag">
                        <?php $dataTag = $cb->getAllTags(); ?>
                    </div>

            </div>


        </div>

        <div id="reste_page">



        </div>


        <script>
            var vardataIngr = <?php echo json_encode($dataIngr); ?>;
            var vardataTag = <?php echo json_encode($dataTag); ?>;
            var vardataQte =  <?php echo json_encode($dataQte); ?>;
            console.log(vardataQte);
        </script>
<?php
    }
}
?>