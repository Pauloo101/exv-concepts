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
        Schema::create('visa_forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable(false)->unique();
            $table->string('mobile_number')->nullable(true);;
            $table->string('country_origin')->nullable(true);;
            $table->string('accepted')->nullable(true);
            // $table->string('cas_issued');
            // $table->string('qualification_proof');
            // $table->string('resident_permit_date');
            // $table->string('dbs_issued_date');
            // $table->string('employment_reference');
            // $table->string('character_reference');
            // $table->string('passport_information');
            // $table->string('resident_permit');
            $table->string('address')->nullable(true);;
            $table->string('payment')->nullable(true);;
            $table->string('interview')->nullable(true);;
            $table->string('comments')->nullable(true);;
            $table->longText('files')->nullable(true);;
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
        Schema::dropIfExists('visa_forms');
    }
};
