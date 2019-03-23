<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhoneNumber extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'number',
    ];

    /**
     * Relation with App\User model.
     *
     * @return  \App\User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * Add new row
     *
     * @param array 
     * @return App\User
     */
    public static function add($fields)
    {
        $number = new static();
        $number->fill($fields);
        $number->save();
    
        return $number;
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
