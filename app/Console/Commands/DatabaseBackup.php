<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;

class DatabaseBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Database full backup';

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
        $filename = "cms-backup-" . Carbon::now()->format('Y-m-d');

        $command = "SQLCMD -E -S ".env('DB_HOST')." -Q \"BACKUP DATABASE [cms_dev] TO DISK = N'" . env('BACKUP_PATH') . "' WITH  RETAINDAYS = 14, NOFORMAT, NOINIT,  NAME = N'".$filename."', NOSKIP, NOREWIND, NOUNLOAD,  STATS = 10\" ";

        $returnVar = NULL;
        $output  = NULL;

        exec($command, $output, $returnVar);
        foreach ($output as $out) {
            $this->info($out);
        }
    }
}
