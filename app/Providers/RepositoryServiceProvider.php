<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Interfaces\Seller\ProductInterface;
use App\Repositories\Seller\ProductRepository;

use App\Interfaces\Seller\StoreInterface;
use App\Repositories\Seller\StoreRepository;

use App\Interfaces\Seller\NotificationInterface;
use App\Repositories\Seller\NotificationRepositories;
// ............................Admin.......................................
use App\Interfaces\BrandInterface;
use App\Repositories\BrandRepository;

use App\Interfaces\MembershipInterface;
use App\Repositories\MembershipRepositories;
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        // ............................Admin.......................................
        $this->app->bind(BrandInterface::class, BrandRepository::class);
        $this->app->bind(MembershipInterface::class, MembershipRepositories::class);
        $this->app->bind(CategoryInterface::class, CategoryRepositories::class);


        $this->app->bind(ProductInterface::class, ProductRepository::class);
        $this->app->bind(StoreInterface::class, StoreRepository::class);
        $this->app->bind(NotificationInterface::class, NotificationRepositories::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
