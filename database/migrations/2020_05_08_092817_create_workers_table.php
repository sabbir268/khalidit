<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('gd_phone')->nullable()->comment('Guardian phone number');
            $table->string('email')->nullable();
            $table->string('fb_link')->nullable();
            $table->string('pr_address')->nullable();
            $table->string('cr_address')->nullable();
            $table->string('study')->nullable();
            $table->string('ssc_batch')->nullable();
            $table->tinyInteger('online_experience')->nullable()->comment("0 => Not experience , 1 => Experienced");
            $table->date('dob')->nullable();
            $table->text('misc')->nullable();
            $table->text('doc')->nullable();
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
        Schema::dropIfExists('workers');
    }
}
