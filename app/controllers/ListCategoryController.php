
<?php

class ListCategoryController extends ApplicationController{

    public function listCategoryAction(){
    $name = "";
    $description = "";
    $urlCoverImagen = "";
    
    $category = Category::allCategory();
    // print_r($category);
    

    }

}


?>