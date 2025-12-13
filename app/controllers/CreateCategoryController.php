<?php
class CreateCategoryController extends ApplicationController {

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