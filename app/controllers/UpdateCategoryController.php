<?php
/**
 * Controlador para actualizar una categoría existente.
 * Este controlador maneja la lógica de obtener, ordenar y actualizar una categoría.
 * También prepara los datos para mostrar en la vista.
 */
class UpdateCategoryController extends ApplicationController {
    private $data;
    /**
     * Acción para actualizar una categoría.
     * Obtiene las categorías desde el modelo, las ordena por nombre y procesa el formulario de actualización.
     * Si la solicitud es POST, busca la categoría por ID, actualiza sus datos y redirige.
     * Si no, prepara los datos para mostrar en la vista.
     * @return void No devuelve ningún valor.
     */ 
    public function UpdateCategoryAction(): void {
        $this -> data = UtilityModel::getJsonCategory(); 

        $sortCategoryName = array_column($this->data["category"], 'name');
        array_multisort($sortCategoryName, SORT_ASC, $this->data["category"]);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = (int) ($_POST['id'] ?? '');
                        
            foreach ($this->data["category"] as $cat) {
                if ($cat['id'] == $id) {
                    $name = $_POST['name'] ?? '';
                    $description = $_POST['description'] ?? '';
                    $urlCategoryImg = $_POST['urlCategoryImg'] ?? '';

                    $name = (string) $name;
                    $description = (string) $description;
                    $urlCategoryImg = (string) $urlCategoryImg;

                    $category = new Category($name, $description, $urlCategoryImg);
                    $category->updateCategory($id);

                    header('Location: /listCategories');
                    return;
                }
            }
            
        } else {
            $this -> view -> data = $this -> data; 

        }
    }
}

?>