<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Imports\ItemsImport;
use App\Imports\RequestorsImport;
use App\Models\Transaction;
use App\Models\TransactionHistory;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Requestor;

class InsertDb extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:data {table} {--filename=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import data to db';

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

        // Check if file exists
        $this->info('Checking import file');$this->newLine();
        if(Storage::missing($this->option('filename'))){
            $this->output->error('File not found!');
            return null;
        }
        $table = $this->argument('table');

        if (method_exists($this, $table)
            && is_callable(array($this, $table)))
        {
            $this->$table();
        }
        else
        {
            $this->output->error('Table not found!');
            return null;
        }

        $this->output->success('Import successful');
    }

    public function item()
    {
        //Get next transaction sequence
        $seq = DB::select("SELECT NEXT VALUE FOR dbo.Transaction_Number_seq as 'seq'");

        //Create transaction
        $this->info('Creating transaction');$this->newLine();
        $t = new Transaction;
        $t->transaction_number = 'M-'.Date('mdy').'-'.Str::padLeft(strval($seq[0]->seq), 4, '0');;
        $t->requested_by = 1;
        $t->location_id = 1;
        $t->shift_id = 1;
        $t->updated_by = "System";
        $t->department_id = 1;
        $t->site_id = 1;
        $t->transaction_type_id = 3;
        $t->save();
        $this->info('Done...');$this->newLine();

        //Inserting initial transaction history
        $this->info('Creating transaction history');$this->newLine();
        $h = new TransactionHistory;
        $h->transaction_id = 1;
        $h->wf_state_type_state_id = 9;
        $h->agent = "System";
        $h->save();
        $this->info('Done...');$this->newLine();

        //Import from file
        $this->info('Importing from file');$this->newLine();
        (new ItemsImport)->withOutput($this->output)->import($this->option('filename'));
        $this->info('Done...');$this->newLine();

        //Updating initial transaction history
        $this->info('Closing the transaction');$this->newLine();
        $h2 = TransactionHistory::find($h->id);
        $h2->wf_state_type_outcome_id = 20;
        $h2->save();

        //Inserting closing transaction history
        $h3 = new TransactionHistory;
        $h3->transaction_id = 1;
        $h3->wf_state_type_state_id = 15;
        $h3->agent = 'System';
        $h3->save();
        $this->info('Done...');$this->newLine();
    }

    public function requestor()
    {
        //Import from file
        $this->info('Importing from file');$this->newLine();
        (new RequestorsImport)->withOutput($this->output)->import($this->option('filename'));
        $this->info('Done...');$this->newLine();
    }
}
