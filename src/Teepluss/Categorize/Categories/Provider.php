<?php namespace Teepluss\Categorize\Categories;

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
     * @param  string $id
     * @return Attachment
     */
    public function findById($id)
    {
        $category = $this->createModel();

        return $category->whereId($id)->first();
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