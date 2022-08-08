<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'message',
        'profileId',
        'authorId',
        'answeredCommentId',
        'created_at',
        'isReply'
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
