<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tjphippen\Models\Laddr;

class Transaction extends Laddr
{
    use HasFactory;

    protected $relations = [
        ['belongsTo', 'accounts', Account::class, 'inout,output', 'id,id'],
    ];

    protected $fillable = [
        'input',
        'output',
        'amount',
    ];

    public function accounts()
    {
        return $this->belongsTo(Account::class, 'inout,output', 'id,id');
    }
}

