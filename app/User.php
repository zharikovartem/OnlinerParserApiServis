<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Task;

/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $status
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read int|null $clients_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\app\Models\Languige\EnglishWord[] $toLearn
 * @property-read int|null $to_learn_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @property-read int|null $tokens_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\app\Models\Languige\EnglishWord[] $vocabylary
 * @property-read int|null $vocabylary_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
            'status_c',
            'status_s',
            'status_r',
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
            'status_c',
            'status_s',
            'status_r',
            'progress_ru_en_c',
            'progress_en_ru_c',
            'progress_ru_en_s',
            'progress_en_ru_s',
            'progress_ru_en_r',
            'progress_en_ru_r'
            )
        ->where('status', 'toLearn');

        // foreach ($data as $key => $value) {
        //     $data[$key]->relations;
        // }

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
