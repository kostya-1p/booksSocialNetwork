<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->renameColumn('profile_id', 'profileId');
            $table->renameColumn('author_id', 'authorId');
            $table->renameColumn('answered_comment_id', 'answeredCommentId');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->renameColumn('profileId', 'profile_id');
            $table->renameColumn('authorId', 'author_id');
            $table->renameColumn('answeredCommentId', 'answered_comment_id');
        });
    }
};
