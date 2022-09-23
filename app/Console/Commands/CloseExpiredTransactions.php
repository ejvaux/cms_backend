<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use \App\Models\Transaction;
use \App\Models\TransactionHistory;
use \App\Models\Setting;

class CloseExpiredTransactions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transactions:expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Close expired/abandoned transactions';

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
        $expire_minutes = Setting::get('transaction_expiration');
        $expireTime = \Carbon\Carbon::now()->subMinutes($expire_minutes);

        /**
         *  Get transactions with status CREATE_REQUEST, ITEM_RECEIVE, CREATE_RETURN id['5','9','10']
         *  and transaction history less than expireTime
         */

        $transactions = \App\Models\Transaction::with('latest_history')
                        ->whereHas('latest_history', function($query) use($expireTime){
                            $query->whereIn('wf_state_type_state_id',['5','9','10']);
                            $query->whereNull('wf_state_type_outcome_id');
                            $query->where('updated_at','<=',$expireTime);
                        })->get();

        if(count($transactions) > 0){
            foreach ($transactions as $transaction) {
                //Update transaction updated_by column
                $expired_transaction = Transaction::find($transaction->id);
                $expired_transaction->updated_by = "SYSTEM";
                $expired_transaction->save();

                // Updated outcome on latest history - EXPIRED, id:24
                $latest_history = TransactionHistory::where('id',$transaction->latest_history->id)->first();
                $latest_history->wf_state_type_outcome_id = 24;
                $latest_history->agent = "SYSTEM";
                $latest_history->save();

                // Insert new history - TRANSACTION_CLOSED, id:15
                $new_history = new TransactionHistory;
                $new_history->transaction_id = $transaction->id;
                $new_history->wf_state_type_state_id = 15;
                $new_history->save();
            }
            foreach ($transactions as $transaction) {
                $this->info("[".Carbon::now()."] ".$transaction->transaction_number.' expired.');
            }
        }
    }
}
