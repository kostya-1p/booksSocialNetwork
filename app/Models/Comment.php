<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    private string $title;
    private string $message;

    private int $profileId;
    private int $authorId;
    private int $answeredCommentId;

    public function answeredComment(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Comment::class, 'answered_comment_id');
    }
}
