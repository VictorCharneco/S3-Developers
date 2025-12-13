<?php
class UpdateCategoryController extends ApplicationController {
    private $data;
    
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