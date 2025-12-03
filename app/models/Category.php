<?php

class Category extends Model{

    private $table = 'categorias';
    
    public $id;
    public $nombre;
    public $descripcion;
    
    public function __construct($nombre, $descripcion) {
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
    }

  // veure tot
    public static function allCat(): array {
        $data = UtilityModel::getJsonData();
        return (isset($data["categoria"]) && $data["categoria"] !== null) ? $data["categoria"] : [];
        // TERNARI - isset s'utilitza per comprobar si una variable està i no es nula.

    }

 // nova
    public function createCat(): void {
        $data = UtilityModel::getJsonData();
        
        // ternari nou ID
        $this->id = empty($data["category"]) ? 1 : end($data["category"])["id"] + 1;
        
        $data["categoria"][] = [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion
        ];
        
        UtilityModel::saveJsonData($data);
    }
    
    public function updateCat(): void {
        $data = UtilityModel::getJsonData();
        
        foreach ($data["categoria"] as $categorias => $categoria) {
            if ($categoria['id'] == $this->id) {
                $data["categoria"][$categorias] = [
                    'id' => $this->id,
                    'nombre' => $this->nombre,
                    'descripcion' => $this->descripcion
                ];
                break;
            }
        }
        
        UtilityModel::saveJsonData($data);
    }
       
    public static function deleteCat($id): void {
        $data = UtilityModel::getJsonData();
        foreach ($data["categoria"] as $categorias => $categoria) {
            if ($categoria['id'] == $id) {
                unset($data["categoria"][$categorias]); // unset, elimina un elemento de un array
                $data["categoria"] = array_values($data["categoria"]);
                UtilityModel::saveJsonData($data);
                return;
            }
        }
    }

}

?>