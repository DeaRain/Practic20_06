<?php
namespace app\modules\models\services;

use app\models\entities\Category;
use app\models\repositories\CategoryRepository;
use app\modules\models\forms\CategoryForm;

class CategoryGridService
{
    public function EntityToForm(Category $category)
    {
        $form = new CategoryForm();
        $form->name = $category->name;
        $form->descr = $category->descr;
        return $form;
    }

    public function create(CategoryForm $form)
    {
        $category = Category::create($form->name, $form->descr);
        $category->setPhoto($form->imageFile);
        if ((new CategoryRepository())->save($category)) {
            return $category->id;
        }
        return false;
    }

    public function update(Category $category, CategoryForm $form)
    {
        $category->edit($form->name, $form->descr);
        $category->setPhoto($form->imageFile);
        return (new CategoryRepository())->save($category);
    }

    public function remove($id)
    {
        $category = (new CategoryRepository())->findModel($id);
        return (new CategoryRepository())->remove($category);
    }
}