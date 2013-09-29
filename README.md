## Multi Level Category.

Categorize is a category management for Laravel 4.

### Installation

- [Categorize on Packagist](https://packagist.org/packages/teepluss/categorize)
- [Categorize on GitHub](https://github.com/teepluss/laravel4-categorize)

To get the lastest version of Theme simply require it in your `composer.json` file.

~~~
"teepluss/categorize": "dev-master"
~~~

You'll then need to run `composer install` to download it and have the autoloader updated.

Once Attach is installed you need to register the service provider with the application. Open up `app/config/app.php` and find the `providers` key.

~~~
'providers' => array(

    'Teepluss\Categorize\CategorizeServiceProvider'

)
~~~

Publish config using artisan CLI.

~~~
php artisan config:publish teepluss/categorize
~~~

Migrate tables.

~~~
php artisan migrate --package=teepluss/categorize
~~~

## Usage

Creating category as a root.
~~~php
$categorize = Categorize::prepare(array(
    'type'        => 'Product',
    'title'       => 'Hardware',
    'description' => 'Hardware is a ...'
));

$categorize->makeRoot();
~~~

Creating category as a child of parent.
~~~php
$categorize = Categorize::prepare(array(
    'type'        => 'Product',
    'title'       => 'Hardware - CPU',
    'description' => 'CPU is a ...'
));

$parent = Categorize::getCategoryProvider()->findById(1);
// or
// $parent = Categorize::getCategoryProvider()->findByName('Hardware');

$categorize->makeChildOf($parent);
~~~

Moving to a new root.
~~~php
$category = Categorize::getCategoryProvider()->findByName('Hardware - CPU');

$category->makeRoot();
~~~

Moving to another parent.
~~~php
$category = Categorize::getCategoryProvider()->findByName('Hardware - CPU');

$parent = Categorize::getCategoryProvider()->findByName('Software');

$category->makeChildOf($root);
~~~

Update information.
~~~php
$category = Categorize::getCategoryProvider()->findByName('Hardware - CPU');
$category->fill(array(
    'title'       => 'Software - Office',
    'description' => 'Documenting'
));

$category->save();
~~~

Delete with children.
~~~php
$category = Categorize::getCategoryProvider()->findByName('Hardware');

$category->deleteWithChildren();
~~~

List category as tree.
~~~php
$category = Categorize::getCategoryProvider()->findByName('Hardware');

var_dump($category->getChildren()->toArray());
~~~

Build categories as tree.
~~~php
$categories = Categorize::getCategoryProvider()->whereType('Blog')->get();

var_dump(Categorize::tree($categories)->toArray());
~~~

## Using categorize with model.

Define relation to model
~~~php
public function categories()
{
    return $this->morphMany('Teepluss\Categorize\CategoryRelates\Relate', 'contentable');
}
~~~

Push content to a category.
~~~php
$category = Categorize::getCategoryProvider()->findByName('Hardware - CPU');

$blog = Blog::find(24);
$blog->categories()->create(array('category_id' => $category->id));
~~~

List contents that belongs to a category.
~~~php
$contentIds = Categorize::getCategoryProvider()->findById(1)->relates()->whereContentableType('Blog')->lists('contentable_id');
// or
// $contentIds = Categorize::getCategoryRelateProvider()->whereContentableType('Blog')->whereCategoryId(1)->lists('contentable_id');

$blogs = Blog::find($contentIds);

var_dump($blogs->toArray());
~~~

## Support or Contact

If you have some problem, Contact teepluss@gmail.com


<a href='http://www.pledgie.com/campaigns/22201'><img alt='Click here to lend your support to: Donation and make a donation at www.pledgie.com !' src='http://www.pledgie.com/campaigns/22201.png?skin_name=chrome' border='0' /></a>
