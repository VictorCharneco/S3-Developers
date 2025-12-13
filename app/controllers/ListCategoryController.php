
<?php

/**
 * Controlador para listar todas las categorías.
 * Este controlador maneja la lógica de obtener y mostrar todas las categorías disponibles.
 */
class ListCategoryController extends ApplicationController{
    /**
     * Acción para listar todas las categorías.
     * Obtiene todas las categorías desde el modelo Category y las almacena en una variable.
     * Puede utilizarse para mostrar la lista en una vista.
     * @return void No devuelve ningún valor explícito, pero almacena los datos para la vista.
     */
    public function listCategoryAction(){
    $name = "";
    $description = "";
    $urlCoverImagen = "";
    
    $category = Category::allCategory();
    // print_r($category);
    

    }

}


?>