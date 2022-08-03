<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'message',
        'profileId',
        'authorId',
        'answeredCommentId',
        'created_at'
    ];

    public function answeredComment(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Comment::class, 'answeredCommentId');
    }

    public function commentAuthor()
    {
        return $this->belongsTo(User::class, 'authorId');
    }
}
