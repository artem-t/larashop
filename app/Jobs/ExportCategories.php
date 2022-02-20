<?php

namespace App\Jobs;

use App\Models\Category;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ExportCategories implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $categories = Category::get()->toArray();
        $fileName = base_path() . '/storage/app/public/public/export/' . date("m.d.y.H:i") . '.csv';
//        dd($fileName);
        $file = fopen($fileName, 'w+');
        $columns =  [
            'id',
            'name',
            'description',
            'picture',
            'created_at',
            'updated_at',
        ];
        fputcsv($file, $columns, ';');
        foreach ($categories as $category){
            $category['name'] = iconv('utf-8', 'utf-8', $category['name']);
            $category['description'] = iconv('utf-8', 'utf-8', $category['description']);
            $category['picture'] = iconv('utf-8', 'utf-8', $category['picture']);
            fputcsv($file, $category, ';');

        }
        fclose($file);
    }
}
