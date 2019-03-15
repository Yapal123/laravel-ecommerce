<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\ClientController;
use Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);  
        
        view()->composer('client.Sidebar',function($view){   
                $controller = new ClientController;
                $part = explode('/', $_SERVER['REQUEST_URI']);
                $categ = $controller->categorySidebar($part['2'])['cats'];
                $category = $categ;
                $var =  [
                            'prods' => $controller->categorySidebar($part['2'])['prods'],
                            'cat' =>$category,
                            'props' => $controller->categorySidebar($part['2'])['props'],
                            'propsN' => $controller->categorySidebar($part['2'])['propsN'],
                        ];
               
               $view->with('myVar',$var); 

            });
        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
