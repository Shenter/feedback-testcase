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



    /**
     * Пользователь, кому принадлежит отзыв
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
