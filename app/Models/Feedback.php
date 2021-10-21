<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth;

class Feedback extends Model
{

    use HasFactory;
    protected $table = 'feedbacks';
    protected $fillable = ['title', 'message', 'attach', 'user_id'];
    public $attach;
    public $message;
    public $title;


    /**
     * Пользователь, кому принадлежит отзыв
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
