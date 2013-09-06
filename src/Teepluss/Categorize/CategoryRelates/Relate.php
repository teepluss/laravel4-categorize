<?php namespace Teepluss\Categorize\CategoryRelates;

use Illuminate\Database\Eloquent\Model;
use Teepluss\Categorize\CategoryRelates\RelateInterface;

class Relate extends Model implements RelateInterface {

    /**
     * Timestamps.
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * Model table.
     *
     * @var string
     */
    protected $table = 'category_relates';

    /**
     * Guarded.
     *
     * @var array
     */
    protected $guarded = array();

    /**
     * Morph to any content.
     *
     * @return object
     */
    public function contentable()
    {
        return $this->morphTo();
    }

}