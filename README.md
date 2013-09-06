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

## Usage

...... Wait a moment.

## Support or Contact

If you have some problem, Contact teepluss@gmail.com

[![Alt Buy me a beer](https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif)](
https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=admin%40jquerytips%2ecom&lc=US&item_name=Teepluss&no_note=0&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHostedGuest)
