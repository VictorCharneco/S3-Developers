<?php

/**
* Controller to manage category deletion.
* This class extends ApplicationController and provides an action
* to delete a category identified by its ID obtained via GET.
*/
class DeleteCategoryController extends ApplicationController {

    /**
    * Action to delete a category based on the ‘id’ parameter in the URL.
    * Retrieves the category ID via $_GET[‘id’], executes the static 
    * deleteCategory function of the Category class to delete it, and stores
    * a status message in the session. Finally, redirects to /deleteCategories.
    * Does not receive parameters and does not return a value.
    * Does not receive parameters and does not return a value.
    * @return void
    */
    public function deleteCategoryAction(): void {
        if (isset($_GET['id'])) {
            $id = (int) $_GET['id'];

           $message = Category::deleteCategory($id);

            $_SESSION['message'] = $message;

            header("Location: /deleteCategories");
            exit;
        }
    }
}
       
?>