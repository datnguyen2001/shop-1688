<?php

namespace App\Providers;

use App\Models\CategoryModel;
use App\Models\CategoryPostModel;
use App\Models\SupportStaffModel;
use App\Models\SystemModel;
use Illuminate\Support\ServiceProvider;

class HeaderProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $header = CategoryPostModel::all();
        $support = SupportStaffModel::all();
        $system = SystemModel::first();

        view()->share('header', $header);
        view()->share('support', $support);
        view()->share('system', $system);
    }
}
