<?php

namespace Browser;

class Liste
{
    function generateliste($cb): void
    { ?>

        <div id="filtres">

            <div id="filtre_ingredients">
                <form>

                    <input id="search_ingredient" type="text" placeholder="Quels ingrédients" name="ingredient">

                    <div id="checkbox_ingredient">
                        <?php $dataIngr = $cb->getAllIngredients(); ?>
                        
                        <?php if (isset($_GET["idRecette"])) {
                            $array = array();
                            foreach ($dataIngr as $idIngr) {
                                $result = $cb->getIngrQuantities($idIngr->idIngredient, $_GET["idRecette"]);

                                if ($result != null) {
                                    echo $result[0]->quantite . " " . $result[0]->unite . "<br>";
                                } else {
                                    echo "aucun" . "<br>";
                                }
                                array_push($array, $result);
                                
                            }
                           
                        } ?>
                        
                    </div>

                </form>


            </div>

            <div id="filtre_tags">
                <form>

                    <input id="search_tag" type="text" placeholder="Quels tags">

                    <div id="checkbox_tag">
                        <?php $dataTag = $cb->getAllTags(); ?>
                    </div>

                </form>
            </div>


        </div>

        <div id="reste_page">



        </div>


        <script>
            var vardataIngr = <?php echo json_encode($dataIngr); ?>;
            var vardataTag = <?php echo json_encode($dataTag); ?>;
            var vardataQte =  <?php echo json_encode($array); ?>;
            console.log(vardataQte);
        </script>
<?php
    }
}
?>