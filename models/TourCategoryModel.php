<?php
require_once PATH_ROOT . "models/TourCategoryModel.php";
class TourCategoryModel extends BaseModel
{
    protected $table = "tour_category";


    // Lấy tất cả danh mục tour
    public function getAll()
    {
        $sql = "SELECT * FROM {$this->table} ORDER BY id DESC";
        return $this->query($sql)->fetchAll();
    }

    // Lấy 1 danh mục theo ID
    public function find($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        return $this->query($sql, [$id])->fetch();
    }

    // Thêm danh mục
    public function create()
    {
        $categoryModel = new TourCategoryModel();
        $tourCategories = $categoryModel->getAll();   // truyền vào view
        include PATH_VIEW . 'tours/add.php';
    }


    // Cập nhật danh mục
    public function updateCategory($id, $name)
    {
        $sql = "UPDATE {$this->table} SET name = ? WHERE id = ?";
        return $this->execute($sql, [$name, $id]);
    }

    // Xóa danh mục
    public function deleteCategory($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = ?";
        return $this->execute($sql, [$id]);
    }
}
