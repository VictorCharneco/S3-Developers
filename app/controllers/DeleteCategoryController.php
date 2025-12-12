<?php
class DeleteCategoryController extends ApplicationController {
    
    public function deleteCategoryAction(): void {
        if (isset($_GET['id'])) {
            $id = (int) $_GET['id'];

            Category::deleteCategory($id);
            
        }
    }
}

?>