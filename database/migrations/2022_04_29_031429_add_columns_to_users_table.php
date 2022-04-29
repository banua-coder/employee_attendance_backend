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
        Schema::table('users', function (Blueprint $table) {

            $table->after('name', function ($table) {
                $table->date('date_of_birth')->nullable();
                $table->string('username', 50)
                    ->nullable()
                    ->unique();
                $table->foreignId('gender_id')
                    ->constrained('genders', 'id')
                    ->cascadeOnDelete()
                    ->cascadeOnUpdate();
                $table->foreignId('religion_id')
                    ->constrained('religions', 'id')
                    ->cascadeOnDelete()
                    ->cascadeOnUpdate();
                $table->string('email')->nullable()->change();
                $table->string('id_card_number', 18)
                    ->nullable()
                    ->unique();
                $table->text('face_data')->nullable();
                $table->text('profile_picture')->nullable();
                $table->datetime('suspended_until')->nullable();
            });

            $table->index('username');
            $table->index('id_card_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex('username');
            $table->dropIndex('id_card_number');
            $table->dropForeign(['gender_id']);
            $table->dropForeign(['religion_id']);
            $table->dropColumn('date_of_birth');
            $table->string('email')->unique()->change();
            $table->dropColumn('username');
            $table->dropColumn('id_card_number');
            $table->dropColumn('face_data');
            $table->dropColumn('profile_picture');
        });
    }
};
