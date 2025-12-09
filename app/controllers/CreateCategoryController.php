<?php

class CreateCategoryController extends ApplicationController {

    public function createCategoryAction() {
        if ($this->getRequest()->isPost()) {
        $name = $_POST['name'] ?? '';
        $description = $_POST['description'] ?? '';
        $urlCategoryImg = $_POST['urlCategoryImg'] ?? '';
        
    $categoria = new Category($name, $description, $urlCategoryImg);
    $categoria->createCategory();

    // echo "Categoría '{$name}' creada con ID: {$categoria->id}";
    // print_r($categoria);

             header('Location: /listCategories');
            exit();
        }
    }
}

?>