<?php
/**
 * Controlador para la creación de una nueva categoría.
 * Este controlador maneja la lógica de recibir los datos del formulario y crear una categoría.
 */
class CreateCategoryController extends ApplicationController {

    /**
     * Acción para crear una nueva categoría.
     * Recibe los datos del formulario (nombre, descripción e imagen), crea una instancia de Category,
     * y guarda la categoría. Redirige a la lista de categorías tras la creación.
     * @return void No devuelve ningún valor.
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