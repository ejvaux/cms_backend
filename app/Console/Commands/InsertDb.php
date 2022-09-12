<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Imports\ItemsImport;
use Maatwebsite\Excel\Facades\Excel;

class InsertDb extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'insert:db {--filename=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert data to db';

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
        $this->output->title('Starting import');
        //Excel::import(new ItemsImport, $this->option('filename'));
        (new ItemsImport)->withOutput($this->output)->import($this->option('filename'));
        $this->output->success('Import successful');
    }
}
