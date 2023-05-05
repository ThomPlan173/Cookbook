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
                        <?php $dataIngr = $cb->getAllIngredients() ; ?>
                    </div>

                </form>
            </div>

            <div id="filtre_tags">
                <form>

                    <input id="search_tag" type="text" placeholder="Quels tags">

                    <div id="checkbox_tag">
                        <?php $dataTag = $cb->getAllTags() ; ?>
                    </div>

                </form>
            </div>


        </div>

        <div id="reste_page">



        </div>


        <script>
            var vardataIngr = <?php echo json_encode($dataIngr); ?>;
            var vardataTag = <?php echo json_encode($dataTag); ?>;


        </script>
        <?php
    }
}
?>