<?php

namespace App;

use App\Http\Controllers\Languige\Vocabylary\userVocabylaryPovit;
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
        ->withPivot(
            'progress', 
            'status',
            'progress_ru_en_c',
            'progress_en_ru_c',
            'progress_ru_en_s',
            'progress_en_ru_s',
            'progress_ru_en_r',
            'progress_en_ru_r'
            )
        ->where('status', 'learned');
    }

    /**
     * get words who need to learn
     * 
     *
     * @return App\Models\Languige\EnglishWord[]
     */
    public function toLearn()
    {
        $targetClass = 'vocabylary_'.$this->id;

        $data = $this->belongsToMany( 'App\Models\Languige\EnglishWord', $targetClass)
        ->withPivot(
            'progress', 
            'status',
            'progress_ru_en_c',
            'progress_en_ru_c',
            'progress_ru_en_s',
            'progress_en_ru_s',
            'progress_ru_en_r',
            'progress_en_ru_r'
            )
        ->where('status', 'toLearn');

        // foreach ($data as $key => $item) {
        //     // $data[$key]->povit2 = new userVocabylaryPovit($item['povit']);
        //     $data[$key]->povit2 = $item['povit'];
        // }

        foreach ($data as $value) {
            $value['aaa'] = 'aaa';
        }

        // var_dump($data);
        // $data->povit2 = new userVocabylaryPovit($data->povit);

        return $data;
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
