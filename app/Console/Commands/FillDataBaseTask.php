<?php

namespace App\Console\Commands;

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
        $texto = 'Hola joder sot nicolas'.Date("Y-m-d H:i:s");
        Storage::append("archivo.txt",$texto);
        return 0;
    }
}
