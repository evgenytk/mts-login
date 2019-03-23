<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Str;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'middle_name', 'birthday', 'token', 'token_expired'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'token', 'token_expired'
    ];
    
    /**
     * Realtion with \App\PhoneNumber.
     *
     * @return  Illuminate\Support\Collection
     */
    public function phoneNumbers()
    {
        return $this->hasMany(PhoneNumber::class);
    }

    public function generateToken()
    {
        $this->token = Str::random(32);
        $this->token_expired = Carbon::now()->addHours(4)->format('Y-m-d H:i:s');
        $this->save();

        return $this->token;
    }

    public function tokenIsExpired()
    {
        $date = Carbon::parse($this->token_expired);
        $now = Carbon::now();

        if ($now->gt($date)) {
            return true;
        }

        return false;
    }
    
    /**
     * Add new row
     *
     * @param array 
     * @return App\User
     */
    public static function add($fields)
    {
        $user = new static();
        $user->fill($fields);
        $user->save();
    
        return $user;
    }
    
    /**
     * Edit row.
     *
     * @param array 
     * @return void
     */
    public function edit($fields)
    {
        $this->fill($fields);
        $this->save();
    }
    
    /**
     * Remove row.
     *
     * @return void
     */
    public function remove()
    {
        $this->delete();
    }
}
