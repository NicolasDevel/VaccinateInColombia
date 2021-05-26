<?php

namespace App\Console\Commands;

use App\Models\Vaccinate;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
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
        Vaccinate::truncate();
        $data = file_get_contents(env('API_ENDPOINT'));
        $vaccinate = json_decode($data, true);
        $position = array_search('COL',array_column($vaccinate,'iso_code'));
        foreach ( $vaccinate[$position]['data'] as $item){
            Vaccinate::create($item);
        }
        return 0;
    }
}
