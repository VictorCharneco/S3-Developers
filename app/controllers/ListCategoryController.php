<?php

/**
* Controller for listing all categories.
* This controller handles the logic of obtaining and displaying all available categories.
*/
class ListCategoryController extends ApplicationController{

    /**
    * Action to list all categories.
    * Gets all categories from the Category model and stores them in a variable.
    * Can be used to display the list in a view.
    * @return void Does not return any explicit value, but stores the data for the view.
     */
    public function listCategoryAction(){
    $name = "";
    $description = "";
    $urlCoverImagen = "";
    
    $category = Category::allCategory();
    
    }
}

?>