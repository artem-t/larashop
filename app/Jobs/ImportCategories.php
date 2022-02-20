<?php

namespace App\Jobs;

use App\Models\Category;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportCategories implements ShouldQueue
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
        $fileName = base_path() . '/storage/app/public/public/import/categories.csv';
//        dd($fileName);
        $file = fopen( $fileName, 'r+');

        $i = 0;
        $insert = [];
        while ($row = fgetcsv($file, 1000, ';')) {
            if ($i++ == 0) {
                $bom = pack('H*','EFBBBF');
                $row = preg_replace("/^$bom/", '', $row);
                $columns = $row;
                continue;
            }

            $data = array_combine($columns, $row);
            unset($data['id']);
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            $insert[] = $data;
        }

//    dd($data);
        Category::insert($insert);
    }
}
