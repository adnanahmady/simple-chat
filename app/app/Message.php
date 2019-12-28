<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['from', 'to', 'text'];

    /**
     * returns the user that did send the message
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function from_contact()
    {
        return $this->hasOne(User::class, 'id', 'from');
    }
}
