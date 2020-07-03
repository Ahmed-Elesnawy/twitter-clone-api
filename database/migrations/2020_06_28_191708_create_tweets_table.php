<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTweetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tweets', function (Blueprint $table) {

            
            $table->id();
            
            $table->string('title')->default('asdasd');

            $table->string('slug')->nullable();

            $table->text('content');

            $table->string('photo')->nullable();

            $table->unsignedBigInteger('user_id');

            $table->unsignedBigInteger('parent_id')->nullable();

            $table->dateTime('retweet_at')->nullable();

            $table->boolean('is_published')->default(0);

            $table->timestamps();



             /**
             * Foreign Keys
             * 
             */

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');


            $table->foreign('parent_id')
                  ->references('id')
                  ->on('tweets')
                  ->onDelete('cascade');


            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tweets');
    }
}
