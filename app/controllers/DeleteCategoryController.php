<?php

class DeleteCateroryController extends ApplicationController{
    
    public function deleteCategoryAction(){
        
        $id = null;
        
        Category::deleteCat($id);
    
    }
}

?>