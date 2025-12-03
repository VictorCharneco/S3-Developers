<?php

class CreateCategoryController extends ApplicationController{

    public function createCategoryAction() {
    $nombre = "";
    $descripcion = "";

    $categoria = new Category($nombre, $descripcion);

    $categoria->createCat();
    
    }
}

?>