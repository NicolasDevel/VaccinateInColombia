<?php

namespace App\Console\Commands;

use App\Models\Vaccinate;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class FillDataBaseTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fill:task';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cron job that runs every day';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Storage::append("archivo.txt",Vaccinate::all()->count());
        $data = file_get_contents(env('API_ENDPOINT'));
        $vaccinate = json_decode($data, true);
        $position = array_search('COL',array_column($vaccinate,'iso_code'));
        if(Vaccinate::all()->count()===0){
            foreach ( $vaccinate[$position]['data'] as $item){
                Vaccinate::create($item);
            }
        }
        else{
            $length = count($vaccinate[$position]['data'])-1;
            $lastRecordInDataBase = Vaccinate::all()->sortByDesc('id')->take(1)->toArray()[$length-1];
            $lastRecordJson = $vaccinate[$position]['data'][$length];
            if($lastRecordInDataBase['date'] !== $lastRecordJson['date']){
                Vaccinate::create($lastRecordJson);
            }
        }
        return 0;
    }
}
