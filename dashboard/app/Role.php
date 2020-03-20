<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //

    //
    /**
     * The table associated with the model.
     *
     * @var string
     */
    public function users() {
        return $this->belongsToMany(User::class, 'users_roles');
    }
}
