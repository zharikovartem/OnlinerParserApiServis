<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
    // public function vocabylary()
    // {
    //     return $this->belongsToMany(Vocabulary::class);
    // }

    public function vocabylary()
    {
        $targetClass = 'vocabylary_'.$this->id;
        return $this->belongsToMany( 'App\Models\Languige\EnglishWord', $targetClass)
        ->withPivot('progress')
        ->withPivot('status')
        ->where('status', 'learned');
    }

    public function toLearn()
    {
        $targetClass = 'vocabylary_'.$this->id;
        $pivot = $this->belongsToMany( 'App\Models\Languige\EnglishWord', $targetClass)
        ->withPivot('progress')//->toJson()
        ->withPivot('status')
        ->where('status', 'toLearn');

        // var_dump($pivot);

        // $pivot->status = json_decode($pivot->status, true);

        return $pivot;
    }

    public function createVocabylaryRelations()
    {
        # create relations model
        Schema::create('vocabylary_'.$this->id, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            
            $table->text('status');
            $table->json('progress')->nullable();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('english_word_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('english_word_id')->references('id')->on('EngleshWords');
        });
    }
}
