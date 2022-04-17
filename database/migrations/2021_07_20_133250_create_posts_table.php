<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            /* $table->integer('user_id')->unsigned()->index();  or:
            onDelete('cascade') will delete all user posts if we delete this user
            Laravel also provides support for creating foreign key constraints, which are used to force referential integrity at the database leve,
            foreignId method will create an insigned big integer equivalent column,
            constrained method will use conventions to determine the table and column name being referenced*/
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('body');
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
        Schema::dropIfExists('posts');
    }
}
