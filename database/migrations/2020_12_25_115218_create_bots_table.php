<?php

use App\Models\Bot;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bots', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->string('bot_user_id')->comment('LINE Botの内部ID');
            $table->string('basic_id')->comment('LINE BotのアカウントID');
            $table->string('alias')->unique();
            $table->enum('status', [Bot::STATUS_INACTIVE, Bot::STATUS_ACTIVE]);
            $table->string('display_name');
            $table->string('channel_secret');
            $table->string('channel_access_token');
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
        Schema::dropIfExists('bots');
    }
}
