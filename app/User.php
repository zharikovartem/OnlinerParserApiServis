<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

use App\Task;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'status', 'view_settings'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     * Атрибуты, которые следует приводить к собственным типам.
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
        $this->save();
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    // public function updateRememberToken(UserContract $user, $token)
    // {
    //     $user->setRememberToken($token);
    //     $timestamps = $user->timestamps;
    //     $user->timestamps = false;
    //     $user->save();
    //     $user->timestamps = $timestamps;
    // }

    public function getToDoList() 
    {
        $toDoList = Task::where('user_id', $this->id)
        ->get();
        $this->toDoList = $toDoList;
    }

    /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function vocabylary()
    {
        // return $this->belongsToMany(Vocabulary::class);
        return $this->name;
    }

    // public function createvacub
}
