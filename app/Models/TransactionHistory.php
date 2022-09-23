<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionHistory extends Model
{
    use HasFactory;

    const CREATED_AT = null;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'transaction_history';

    /**
     * All of the relationships to be touched.
     *
     * @var array
     */
    protected $touches = ['transaction'];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function state()
    {
        return $this->belongsTo(WorkflowStateType::class, 'wf_state_type_state_id');
    }

    public function outcome()
    {
        return $this->belongsTo(WorkflowStateType::class, 'wf_state_type_outcome_id');
    }

    public function qual()
    {
        return $this->belongsTo(WorkflowStateType::class, 'wf_state_type_qual_id');
    }


}
