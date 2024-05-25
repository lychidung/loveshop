<?php

namespace App\Providers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Order_Details;
use App\Models\Product;
use App\Models\Product_Categorie;
use App\Models\Product_Colors;
use App\Models\Product_Option_Sizes;
use App\Models\ProductItem;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
        // Định nghĩa các đối tượng
        Route::model('products', Product::class);
        Route::model('ProductItem', ProductItem::class);
        Route::model('ProductCategories', Product_Categorie::class);
        Route::model('ProductColor', Product_Colors::class);
        Route::model('ProductSize', Product_Option_Sizes::class);
        Route::model('Vouchers', Voucher::class);
        Route::model('Orders', Order::class);
        Route::model('OrderDetails', Order_Details::class);
        Route::model('Users', User::class);
        Route::model('Customers', Customer::class);

    }
}
