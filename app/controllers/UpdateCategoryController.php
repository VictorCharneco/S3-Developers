<?php
class UpdateCategoryController extends ApplicationController {

    public $data;
    
    public function UpdateCategoryAction() {
        $this -> data = UtilityModel::getJsonCategory(); 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? '';
            echo $id;
            foreach ($this->data["category"] as $cat) {
                if ($cat['id'] == $id) {
                    $category = new Category($_POST['name'], $_POST['description'], $_POST['urlCategoryImg'] ?? '');
                    $category->updateCategory($id);
                    header('Location: /listCategories');
                    return;
                }
            }
            
        }else {
            $this -> view -> data = $this -> data; 
        }
    }
}
?>


