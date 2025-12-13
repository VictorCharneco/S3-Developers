<?php
/**
 * Controlador para la eliminación de una categoría.
 * Este controlador maneja la lógica de eliminar una categoría a partir de su ID.
 */
class DeleteCategoryController extends ApplicationController {
    /**
     * Acción para eliminar una categoría.
     * Recibe el ID de la categoría desde la URL, lo convierte a entero y llama al método estático
     * de la clase Category para eliminar la categoría.
     * @return void No devuelve ningún valor.
     */ 
    public function deleteCategoryAction(): void {
        if (isset($_GET['id'])) {
            $id = (int) $_GET['id'];

            Category::deleteCategory($id);
            
        }
    }
}

?>