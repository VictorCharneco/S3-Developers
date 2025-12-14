<?php
class Category extends Model{
    
    private int $id;
    private string $name;
    private string $description;
    private string $urlCategoryImg;
    
    public function __construct($name, $description, $urlCategoryImg = "") {
        $this->name = $name;
        $this->description = $description;
        $this->setUrlCategoryImg($urlCategoryImg);
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getUrlCategoryImg(): string {
        return $this->urlCategoryImg;
    }

    public function setUrlCategoryImg(string $urlCategoryImg): void {
        $this->urlCategoryImg = $urlCategoryImg;
    }

    /**
    * Get all categories.
    * @return array what containing the categories.
    */
    public static function allCategory(): array {
        $data = UtilityModel::getJsonCategory();
        return $data["category"];
    }

    /**
    * Create a new category and save it in the JSON file.
    * Upload an image associated with the category, generate a unique ID (uniqid()). 
    * Save data in the JSON file.
    * @return void Returns NO value.
    */
    public function createCategory(): void {
        $uploadDir = 'images/categoryImg/';
        $fileName = $_FILES['file']['name'];
        $data = UtilityModel::getJsonCategory();

        $this->id = empty($data["category"]) ? 1 : end($data["category"])["id"] + 1;
        
        $randomId = uniqid();
        $newFileName = ($randomId . '_' . $this->getId()) . '_' . $fileName;

        if ($fileName) {
            move_uploaded_file($_FILES['file']['tmp_name'], $uploadDir . $newFileName);
            $this->setUrlCategoryImg('\/images\/categoryImg\/' . $newFileName); 
        }

        $data["category"][] = [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'urlCategoryImg' => $this->getUrlCategoryImg()
        ];

        UtilityModel::saveJsonCategory($data);
    }

    
    /**
    * Updates an existing category and its associated image.
    * Search for the category by its ID, upload a new image if provided, delete the previous one,
    * and update the data in the JSON file. If no image is uploaded, keep the existing one.
    * @param int $id ID of the category to be updated.
    * @return void Returns NO value.
    */
    public function updateCategory(int $id): void {
        $this->setId($id);
        $fileName = $_FILES['file']['name'];
        $data = UtilityModel::getJsonCategory();

        $currentCategory = null;
        foreach ($data["category"] as $category) {
            if ($category['id'] === $id) {
                $currentCategory = $category;
                break;
            }
        }

        if ($fileName) {
            if ($currentCategory['urlCategoryImg'] !== '') {
                $currentImagePath = '.' . str_replace('\/', '/', $currentCategory['urlCategoryImg']);
                if (file_exists($currentImagePath)) {
                    unlink($currentImagePath);
                }
            }
            $randomId = uniqid();
            $UpdateFileName = ($randomId . '_' . $this->getId()) . '_' . $fileName;
            move_uploaded_file($_FILES['file']['tmp_name'], 'images/categoryImg/' . $UpdateFileName);
            $this->setUrlCategoryImg('\/images\/categoryImg\/' . $UpdateFileName);
        } else {
            if (empty($this->urlCategoryImg) && $currentCategory) {
                $this->setUrlCategoryImg($currentCategory['urlCategoryImg']);
            }
        }

        foreach ($data["category"] as $index => $category) {
        if ($category['id'] === $id) {
            $data["category"][$index]= [
                'id' => $id,
                "name" => $category["name"],
                'description' => $this->description,
                'urlCategoryImg' => $this->getUrlCategoryImg()
            ];
            break;

            }
        }

        UtilityModel::saveJsonCategory($data);
    }  

    /**
     * Checks if a category is being used by any movie.
     * @param int $id The ID of the category to check.
     * @return bool Returns true if the category is being used, false otherwise.
     */
    private static function isCategoryUsed(int $id): bool {
        $filmsData = UtilityModel::getFilmsData();
        $movies = $filmsData['movie'] ?? [];

        foreach ($movies as $movie) {
            if (isset($movie['categories']) && in_array($id, (array)$movie['categories'])) {
                return true;
            }
        }
        return false;
    }

    /**
     * Updates the category IDs in all movies based on the provided mapping.
     * @param array $idMap An associative array mapping old category IDs to new ones.
     * @return void Returns NO value.
     */
    private static function updateFilmCategoriesIds(array $idMap): void {
        $filmsData = UtilityModel::getFilmsData();
        $movies = $filmsData['movie'] ?? [];

        foreach ($movies as &$movie) {
            if (isset($movie['categories']) && is_array($movie['categories'])) {
                foreach ($movie['categories'] as &$catId) {
                    if (isset($idMap[$catId])) {
                        $catId = $idMap[$catId];
                    }
                }
                unset($catId);
            }
        }
        unset($movie);

        $filmsData['movie'] = $movies;
        UtilityModel::saveFilmData($filmsData);
    }

    /**
     * Deletes a category by its ID, updating the IDs of the remaining categories and movies.
     * @param int $id The ID of the category to delete.
     * @return string|null Returns a message if the category cannot be deleted, or null if it was deleted successfully.
     */
    public static function deleteCategory(int $id): ?string {
        if (self::isCategoryUsed($id)) {
            return "Sorry, the category cannot be deleted because it is assigned to one or more films.";
        }

        $data = UtilityModel::getJsonCategory();
        
        foreach ($data["category"] as $position => $category) {
            if ($category['id'] === $id) {
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
        $idMap = [];
        foreach ($data["category"] as $index => &$category) {
            $oldId = $category['id'];
            $newId = $index + 1;
            $category['id'] = $newId;
            $idMap[$oldId] = $newId;
        }
        unset($category);

        UtilityModel::saveJsonCategory($data);

        self::updateFilmCategoriesIds($idMap);

        return null;
    }    
}

?>