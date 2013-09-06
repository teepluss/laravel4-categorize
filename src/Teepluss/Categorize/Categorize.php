<?php namespace Teepluss\Categorize;

use Closure;
use Illuminate\Config\Repository;
use Teepluss\Categorize\Categories\CategoryInterface as CategoryInterface;
use Teepluss\Categorize\Categories\ProviderInterface as CategoryProviderInterface;
use Teepluss\Categorize\CategoryHierarchy\ProviderInterface as CategoryHierarchyProviderInterface;
use Teepluss\Categorize\CategoryRelates\ProviderInterface as CategoryRelateProviderInterface;

class Categorize {

    protected $config;

    protected $categoryProvider;

    protected $categoryHierarchyProvider;

    protected $categoryRelateProvider;

    protected $data = array();

    public function __construct(Repository $config,
                                CategoryProviderInterface $categoryProvider,
                                CategoryHierarchyProviderInterface $categoryHierarchyProvider,
                                CategoryRelateProviderInterface $categoryRelateProvider)
    {
        $this->config = $config;

        $this->categoryProvider = $categoryProvider;

        $this->categoryHierarchyProvider = $categoryHierarchyProvider;

        $this->categoryRelateProvider = $categoryRelateProvider;
    }

    public function prepare($data)
    {
        return $this->getCategoryProvider()->createModel()->fill($data);
    }

    public function update(CategoryInterface $category)
    {
        $category->fill($this->data)->save();

        return $category;
    }

    public function getCategoryProvider()
    {
        return $this->categoryProvider;
    }

    public function getCategoryHierarchyProvider()
    {
        return $this->categoryHierarchyProvider;
    }

    public function getCategory($id)
    {
        return $this->getCategoryProvider()->findById($id);
    }

}