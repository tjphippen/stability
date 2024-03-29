<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tjphippen\Models\Laddr;

class User extends Laddr
{
    use HasFactory;

    protected $relations = [
        ['hasMany', 'accounts', Account::class]
    ];

    protected $fillable = [
        'name'
    ];

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }
}

