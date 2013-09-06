<?php namespace Teepluss\Categorize\Categories;

use Illuminate\Database\Eloquent\Model;
use Teepluss\Categorize\Categories\CategoryInterface as CategoryInterface;

class Category extends Model implements CategoryInterface {

    protected $table = 'categories';

    protected $guarded = array();

    public static function boot()
    {
        parent::boot();

        // Delete hierarchies first.
        static::deleting(function($model)
        {
            $model->children()->detach();
            $model->parents()->detach();
        });
    }

    public function parents()
    {
        return $this->belongsToMany('\Teepluss\Categorize\Categories\Category', 'category_hierarchy', 'category_id', 'category_parent_id');
    }

    public function children()
    {
        return $this->belongsToMany('\Teepluss\Categorize\Categories\Category', 'category_hierarchy', 'category_parent_id', 'category_id');
    }

    public function makeRoot()
    {
        $this->save();
        $this->parents()->sync(array(0));

        return $this;
    }

    public function makeChildOf(CategoryInterface $category)
    {
        $this->save();
        $this->parents()->sync(array($category->getKey()));

        return $this;
    }

    public function getNested($defination)
    {
        $this->load(implode('.', array_fill(0, 20, $defination)));

        return $this;
    }

    public function getChildren()
    {
        return $this->getNested('children');
    }

    public function getParents()
    {
        return $this->getNested('parents');
    }

    public function deleteWithChildren()
    {
        $ids = array();

        $children = $this->getChildren()->toArray();

        array_walk_recursive($children, function($i, $k) use (&$ids) { if ($k == 'id') $ids[] = $i; });

        foreach ($ids as $id)
        {
            $this->destroy($id);
        }
    }

}