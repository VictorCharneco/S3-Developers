<?php
class DeleteCategoryController extends ApplicationController {
    
    public function deleteCategoryAction() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            
            Category::deleteCategory($id);
            
            // header('Location: /listCategories');
            // exit();
        }
    }
}

?>