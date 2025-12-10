<?php
class Category extends Model{
    
    public $id;
    public $name;
    public $description;
    public $urlCategoryImg;
    
    public function __construct($name, $description, $urlCategoryImg = "") {
        $this->name = $name;
        $this->description = $description;
        $this->urlCategoryImg = $urlCategoryImg;
    }

    public static function allCategory(): array {
        $data = UtilityModel::getJsonCategory();
        return $data["category"];
    }

    public function createCategory(): void {
        $uploadDir = 'images/categoryImg/';
        $fileName = $_FILES['file']['name'];
        
        $data = UtilityModel::getJsonCategory();

        $this->id = empty($data["category"]) ? 1 : end($data["category"])["id"] + 1;
        $newFileName = $this->id . '_' . $fileName;
        
        move_uploaded_file($_FILES['file']['tmp_name'], $uploadDir . $newFileName);
        $this->urlCategoryImg = '\/images\/categoryImg\/' . $newFileName; 

        $data["category"][] = [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'urlCategoryImg' => $this->urlCategoryImg
        ];
        
        UtilityModel::saveJsonCategory($data);
    }
    
    public function updateCategory(int $id): void {
        $this->id = $id;
        $fileName = $_FILES['file']['name'];
        
        $data = UtilityModel::getJsonCategory();

        $currentCategory = null;
        foreach ($data["category"] as $category) {
            if ($category['id'] == $id) {
                $currentCategory = $category;
                break;
            }
        }

        $UpdateFileName = $this->id . '_' . $fileName;

        if ($_FILES['file']['name']) {
            $fileName = $_FILES['file']['name'];
            move_uploaded_file($_FILES['file']['tmp_name'], 'images/categoryImg/' . $UpdateFileName);
            $this->urlCategoryImg = '\/images\/categoryImg\/' . $UpdateFileName;
        } else {
            if (empty($this->urlCategoryImg) && $currentCategory) {
            $this->urlCategoryImg = $currentCategory['urlCategoryImg'];
            }
        }

        foreach ($data["category"] as $index => $category) {
        if ($category['id'] == $id) {
            $data["category"][$index]= [
                'id' => $id,
                "name" => $category["name"],
                'description' => $this->description,
                'urlCategoryImg' => $this->urlCategoryImg
            ];
            break;
            }
        }
    
        UtilityModel::saveJsonCategory($data);
    }  

    public static function deleteCategory(int $id): void {
        $data = UtilityModel::getJsonCategory();
        
        foreach ($data["category"] as $position => $category) {
            if ($category['id'] == $id) {
                if (isset($category['urlCategoryImg']) && $category['urlCategoryImg'] !== '') {
                    $imagePath = str_replace('\/', '/', $category['urlCategoryImg']);
                    $imagePath = "." . $imagePath;
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
                
                unset($data["category"][$position]);
                break;
            }
        }

        $data["category"] = array_values($data["category"]);
        
        foreach ($data["category"] as $index => &$category) {
            $category['id'] = $index + 1;
        }
        unset($category);
        
        UtilityModel::saveJsonCategory($data);
    }

}

?>