<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tjphippen\Models\Laddr;

class Account extends Laddr
{
    use HasFactory;

//    protected $routes = ['name'];

    protected $relations = [
        ['belongsTo', 'user', User::class],
        ['hasMany', 'accounts', Account::class],
        ['hasMany', 'transactions', Transaction::class, 'inout,output', 'id,id'],
    ];

    protected $fillable = [
        'user_id',
        'name',
        'type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'inout,output', 'id,id');
    }

    public function balance()
    {
        $credits = $this->transactions()->where('input', $this->id)->sum('amount');
        $debits = $this->transactions()->where('output', $this->id)->sum('amount');
        return ($credits - $debits);
    }

    public function getBalanceAttribute()
    {
        return $this->balance();
    }

//    public function setDepositAttribute($amount)
//    {
//        return $this->attributes['deposit'] = $amount;
//    }

//    public static function boot()
//    {
//        parent::boot();
//        self::created(function($model){
//            if ($amount = $model->attributes['deposit'])
//            {
//                Transaction::create([
//                    'input' => '', // TODO DEPOSIT ID
//                    'output' => $this->id,
//                    'amount' => $amount,
//                ]);
//            }
//        });
//    }
}

