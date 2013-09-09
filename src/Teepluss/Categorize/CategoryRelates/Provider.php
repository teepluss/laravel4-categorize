<?php namespace Teepluss\Categorize\CategoryRelates;

class Provider implements ProviderInterface {

    /**
     * Default model for category provider.
     *
     * @var string
     */
    protected $model = 'Teepluss\Categorize\CategoryRelates\Relate';

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

    public function getByCategoryId($id)
    {
        return $this->createModel()->whereCategoryId($id)->get();
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