<?php

namespace App\Providers;

use App\Services\Auth\AuthService;
use App\Services\Auth\AuthServiceImplement;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Auth\AuthRepository;
use App\Repositories\Auth\AuthRepositoryImplement;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryImplement;
use App\Repositories\ExpenseVoucher\ExpenseVoucherRepository;
use App\Repositories\ExpenseVoucher\ExpenseVoucherRepositoryImplement;
use App\Services\ExpenseVoucher\ExpenseVoucherService;
use App\Services\ExpenseVoucher\ExpenseVoucherServiceImplement;
use App\Repositories\ExpenseDetail\ExpenseDetailRepository;
use App\Repositories\ExpenseDetail\ExpenseDetailRepositoryImplement;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //Auth Services
        $this->app->bind(
            AuthService::class,
            AuthServiceImplement::class
        );

        //User Repository
        $this->app->bind(
            UserRepository::class,
            UserRepositoryImplement::class
        );

        $this->app->bind(
            ExpenseVoucherRepository::class,
            ExpenseVoucherRepositoryImplement::class
        );

        $this->app->bind(
            ExpenseDetailRepository::class,
            ExpenseDetailRepositoryImplement::class
        );

        $this->app->bind(
            ExpenseVoucherService::class,
            ExpenseVoucherServiceImplement::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
