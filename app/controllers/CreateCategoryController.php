<?php
/**
 * Controller for creating a new category.
 * This controller handles the logic of receiving data from the form and creating a category.
 */
class CreateCategoryController extends ApplicationController {

    /**
    * Action to create a new category.
    * Receives the form data (name, description, and image), creates a Category instance,
    * and saves the category. Redirects to the category list after creation.
    * @return void Returns NO value.
    */
    public function createCategoryAction(): void {
        if ($this->getRequest()->isPost()) {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $urlCategoryImg = $_POST['urlCategoryImg'] ?? '';

            $name = (string) $name;
            $description = (string) $description;
            $urlCategoryImg = (string) $urlCategoryImg;
        
            $categoria = new Category($name, $description, $urlCategoryImg);
            $categoria->createCategory();

            header('Location: /listCategories');
            exit();

        }
    }
}

?>