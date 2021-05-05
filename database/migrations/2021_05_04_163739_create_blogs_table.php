<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('author_id')->constrained('users');
            $table->string('title');
            $table->foreignUuid('main_photo_id')->nullable()->constrained('photos');
            $table->boolean('is_featured')->default(false);
            $table->longText('content');
            $table->integer('read_time')->comment('in seconds');
            $table->integer('like_count')->default(0);
            $table->integer('comment_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
