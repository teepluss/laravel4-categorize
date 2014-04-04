<?php namespace Teepluss\Categorize;

use Closure;
use Illuminate\Config\Repository;
use Illuminate\Database\Eloquent\Collection;
use Teepluss\Categorize\Categories\ProviderInterface as CategoryProviderInterface;
use Teepluss\Categorize\CategoryRelates\ProviderInterface as CategoryRelateProviderInterface;
use Teepluss\Categorize\CategoryHierarchy\ProviderInterface as CategoryHierarchyProviderInterface;

class Categorize {

    /**
     * Repository config.
     *
     * @var \Illuminate\Config\Repository
     */
    protected $config;

    /**
     * Category provider.
     *
     * @var \CategoryProviderInterface
     */
    protected $categoryProvider;

    /**
     * Category hierarchy provider.
     *
     * @var \CategoryHierarchyProviderInterface
     */
    protected $categoryHierarchyProvider;

    /**
     * Category relate provider.
     *
     * @var CategoryRelateProviderInterface
     */
    protected $categoryRelateProvider;

    /**
     * Construct.
     *
     * @param \Illuminate\Config\Repository       $config
     * @param \CategoryProviderInterface          $categoryProvider
     * @param \CategoryHierarchyProviderInterface $categoryHierarchyProvider
     * @param \CategoryRelateProviderInterface    $categoryRelateProvider
     */
    public function __construct(Repository $config,
                                CategoryProviderInterface $categoryProvider,
                                CategoryRelateProviderInterface $categoryRelateProvider,
                                CategoryHierarchyProviderInterface $categoryHierarchyProvider)

    {
        $this->config = $config;

        $this->categoryProvider = $categoryProvider;

        $this->categoryRelateProvider = $categoryRelateProvider;

        $this->categoryHierarchyProvider = $categoryHierarchyProvider;
    }

    /**
     * Change data array to object model.
     *
     * @param  array $data
     * @return object
     */
    public function prepare($data)
    {
        return $this->getCategoryProvider()->createModel()->fill($data);
    }

    /**
     * Get category provider.
     *
     * @return object
     */
    public function getCategoryProvider()
    {
        return $this->categoryProvider;
    }

    /**
     * Get category relate provider.
     *
     * @return object
     */
    public function getCategoryRelateProvider()
    {
        return $this->categoryRelateProvider;
    }

    /**
     * Get category hierarchy provider.
     *
     * @return object
     */
    public function getCategoryHierarchyProvider()
    {
        return $this->categoryHierarchyProvider;
    }

    /**
     * Buiding collections to tree.
     *
     * @param  Collection $source
     * @return object
     */
    public function tree(Collection $source)
    {
        $source->load(implode('.', array_fill(0, 20, 'children')), 'parents');
        
        $source = $source->filter(function($item) {
	        if ($item->parents->count() > 0)
	        {
		        return false;
	        }
	        
	        return true;
        })->values();

        return $source;
    }

}
