<?php namespace Teepluss\Categorize\Categories;

class Provider implements ProviderInterface {

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
     * Creates an attachment.
     *
     * @param  array  $results
     * @return Teepluss\Up\Attachments\AttachmentInterface
     */
    // public function create(array $results)
    // {
    //     return $this->createModel()->add($results);
    // }

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
        $attachment = $this->createModel();

        return $attachment->whereId($id)->first();
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

}