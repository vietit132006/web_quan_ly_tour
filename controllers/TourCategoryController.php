<?php
require_once PATH_ROOT . "models/TourCategoryModel.php";

class TourCategoryController
{
    protected $cateModel;

    public function __construct()
    {
        $this->cateModel = new TourCategoryModel();
    }

    // Danh sách danh mục
    public function index()
    {
        $categories = $this->cateModel->getAll();
        require_once PATH_VIEW . "tour_category/index.php";
    }

    // Thêm danh mục
    public function store()
    {
        $name = $_POST['name'] ?? null;
        if ($name) {
            $this->cateModel->create($name);
        }
        header("Location: index.php?action=tour-category");
    }

    // Xóa danh mục
    public function delete()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->cateModel->deleteCategory($id);
        }
        header("Location: index.php?action=tour-category");
    }
}
