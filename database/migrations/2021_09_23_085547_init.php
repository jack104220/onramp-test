<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Init extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 64)->comment('辨識用名稱');
            $table->string('object_id', 64)->unique()->comment('唯一識別碼');
            $table->text('content')->nullable()->comment('對應內容');
            $table->timestamps();
        });

        Schema::create('tbl_tag_records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('object_id', 64)->comment('唯一識別碼');
            $table->string('session_id', 64)->comment('用戶識別碼');
            $table->tinyInteger('action')->comment('動作');
            $table->tinyInteger('type')->comment('類型');
            $table->float('value', 12, 4)->default(0.0)->comment('價值');
            $table->string('currency', 24)->comment('幣別');
            $table->timestamps();
        });

        Schema::dropIfExists('personal_access_tokens');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_tags');
        Schema::dropIfExists('tbl_tag_record');
    }
}
