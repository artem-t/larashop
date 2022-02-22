<?php

namespace App\Jobs;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ExportProducts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
//        dd(request('category_id'));
//        if (request('category_id')){
//            $products = Product::where('category_id', request('category_id'))->get()->toArray();
//
//        }else{
            $products = Product::get()->toArray();
//        }
//dd($products);
        $fileName = base_path() . '/storage/app/public/public/export/products/' . date("m.d.y.H:i") . '.csv';
//    dd($fileName);
        $file = fopen($fileName, 'w');
        $columns =  [
            'id',
            'name',
            'description',
            'picture',
            'created_at',
            'updated_at',
        ];
        fputcsv($file, $columns, ';');
        foreach ($products as $product){
            $products['name'] = iconv('utf-8', 'utf-8', $product['name']);
            $products['description'] = iconv('utf-8', 'utf-8', $product['description']);
            $products['picture'] = iconv('utf-8', 'utf-8', $product['picture']);
            fputcsv($file, $product, ';');

        }
        fclose($file);
    }
}
