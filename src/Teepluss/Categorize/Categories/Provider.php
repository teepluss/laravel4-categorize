<?php namespace Teepluss\Categorize\Categories;

use \DB;

class Provider implements ProviderInterface {

    /**
     * Default model for category provider.
     *
     * @var string
     */
    protected $model = 'Teepluss\Categorize\Categories\Category';

    /**
     * Constructor.
     *
     * @param void
     */
    public function __construct($model = null)
    {
        // Model pass from service provider.
        if (isset($model))
        {
            $this->model = $model;
        }
    }

    /**
     * Get only root category.
     *
     * @return Category
     */
    public function root()
    {
        $category = $this->createModel();

        $category = $category->whereExists(function($query)
        {
            $query->select(\DB::raw(1))
                  ->from('category_hierarchy')
                  ->whereRaw(DB::getTablePrefix().'categories.id = '.DB::getTablePrefix().'category_hierarchy.category_id')
                  ->where('category_hierarchy.category_parent_id', 0);
        });

        return $category;
    }

    /**
     * Delete method.
     *
     * @param  integer $id
     * @return void
     */
    public function delete($id)
    {
        return $this->createModel()->destroy($id);
    }

    /**
     * Find attachment by id.
     *
     * @param  integer $id
     * @return Category
     */
    public function findById($id)
    {
        $category = $this->createModel();

        return $category->whereId($id)->first();
    }

    /**
     * Find attachment by name.
     *
     * @param  string $name
     * @return Category
     */
    public function findByName($name)
    {
        $category = $this->createModel();

        return $category->whereTitle($name)->first();
    }

    /**
     * Get model name.
     *
     * @return string
     */
    public function getModelName()
    {
        return $this->model;
    }

    /**
     * Create a new instance of the model.
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    public function createModel()
    {
        $class = '\\'.ltrim($this->model, '\\');

        return new $class;
    }

    /**
     * Magic method to look up directly from model.
     *
     * @param  string $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters = array())
    {
        $model = $this->createModel();

        return call_user_func_array(array($model, $method), $parameters);
    }

}
