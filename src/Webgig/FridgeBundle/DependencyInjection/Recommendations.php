<?php

namespace Webgig\FridgeBundle\DependencyInjection;



class Recommendations
{
    private $items   = null;

    private $recipes = null;

    public function recommend($items,$recipes)
    {
        $this->items   = $items;
        $this->recipes = $recipes;

        // Exit early
        if(!is_array($items) || !is_array($recipes)) return false;


        $validRecipes = array();

        foreach ($recipes as $recipe)
        {
              // Get Valid Recipes First. Check for item expiry and available quantity too
            if($this->_isRecipeValid($recipe))
               $validRecipes[] = $recipe;

        }

        if(count($validRecipes)==1)
            return $validRecipes[0]->getName();
        else if(count($validRecipes) > 1 ) //More than one valid recipes found. Do more refining. Find the one with closest expiry date
        {
            foreach ($validRecipes as $recipe) // Find the  lowest difference from current date. Array keys  of the diff[] array  correspond the recipes index.
               $diff[] = $this->_getItemExpirationDiff($recipe);

            // The closest duration of the expiration item. Expiry - Current Date
            return $validRecipes[array_search(min($diff), $diff)]->getName();
        }
        else
           return "Order Takeout";

    }



    protected function _isRecipeValid($recipe)
    {
        if(!$recipe) return false;

        foreach ($recipe->getIngredients() as  $ingredient) {
            //Item Name
            $item_name = $ingredient->getItem();

            // Item Entity
            $item      =  $this->__getItemFromItemsList($item_name);

            // Check expiry;
            if(strtotime(str_replace("/","-",$item->getUseBy())) < time()) return false;

            // Check for quantity avail
            if($item->getAmount() < $ingredient->getAmount()) return false;

        }

        return true;
    }

    protected function _getItemExpirationDiff($recipe)
    {
        if(!$recipe) return false;

        foreach ($recipe->getIngredients() as  $ingredient) {
            //Item Name
            $item_name = $ingredient->getItem();

            // Item Entity
            $item      =  $this->__getItemFromItemsList($item_name);

            // Check expiry;
            if($interval    = strtotime(str_replace("/","-",$item->getUseBy())) - time())
               $intervals[$item_name] = $interval;
        }

        return min($intervals);
    }




    private function __getItemFromItemsList($item_name)
    {

        foreach ($this->items as  $value) {
            if($item_name==$value->getItem())
               return $value;
        }

    }


}
