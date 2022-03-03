<?php

use App\Models\Categories\Category;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('categories:fill-data', function (){
    
    $categories = ['Cliente', 'Proveedor', 'Funcionario Interno'];
    $bar        = $this->output->createProgressBar(count($categories));
    foreach ($categories as $category){
        Category::firstOrCreate(['name' => $category]);
        $bar->advance();
    }
    $bar->finish();
    
})->purpose('fill categories table');

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
