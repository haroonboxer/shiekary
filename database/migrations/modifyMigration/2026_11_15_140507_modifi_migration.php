<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('organizations', function (Blueprint $table) {

            $table->string('created_by')->change();
            $table->string('updated_by')->change()->nullable();
            $table->string('approved_by')->change()->nullable();

            $table->string('created_by_name')->nullable();
            $table->string('updated_by_name')->nullable();
            $table->string('approved_by_name')->nullable();
        });
        Schema::table('presidents', function (Blueprint $table) {
            $table->string('created_by')->change();
            $table->string('updated_by')->change()->nullable();
            $table->string('approved_by')->change()->nullable();

            $table->string('created_by_name')->nullable();
            $table->string('updated_by_name')->nullable();
            $table->string('approved_by_name')->nullable();
        });
        Schema::table('vice_presidents', function (Blueprint $table) {

            $table->string('created_by')->change();
            $table->string('updated_by')->change()->nullable();
            $table->string('approved_by')->change()->nullable();

            $table->string('created_by_name')->nullable();
            $table->string('updated_by_name')->nullable();
            $table->string('approved_by_name')->nullable();
        });
        Schema::table('licenses', function (Blueprint $table) {

            $table->string('created_by')->change();
            $table->string('updated_by')->change()->nullable();
            $table->string('approved_by')->change()->nullable();

            $table->string('created_by_name')->nullable();
            $table->string('updated_by_name')->nullable();
            $table->string('approved_by_name')->nullable();
        });

        Schema::table('employees', function (Blueprint $table) {
            $table->string('created_by')->change();
            $table->string('updated_by')->change()->nullable();
            $table->string('approved_by')->change()->nullable();

            $table->string('created_by_name')->nullable();
            $table->string('updated_by_name')->nullable();
            $table->string('approved_by_name')->nullable();
        });

        Schema::table('vehicles', function (Blueprint $table) {

            $table->string('created_by')->change();
            $table->string('updated_by')->change()->nullable();
            $table->string('approved_by')->change()->nullable();

            $table->string('created_by_name')->nullable();
            $table->string('updated_by_name')->nullable();
            $table->string('approved_by_name')->nullable();
        });

        Schema::table('employee_payments', function (Blueprint $table) {

            $table->string('created_by')->change();
            $table->string('updated_by')->change()->nullable();
            $table->string('approved_by')->change()->nullable();

            $table->string('created_by_name')->nullable();
            $table->string('updated_by_name')->nullable();
            $table->string('approved_by_name')->nullable();
        });
        Schema::table('weapons', function (Blueprint $table) {

            $table->string('created_by')->change();
            $table->string('updated_by')->change()->nullable();
            $table->string('approved_by')->change()->nullable();

            $table->string('created_by_name')->nullable();
            $table->string('updated_by_name')->nullable();
            $table->string('approved_by_name')->nullable();
        });
        Schema::table('weapon_payments', function (Blueprint $table) {

            $table->string('created_by')->change();
            $table->string('updated_by')->change()->nullable();
            $table->string('approved_by')->change()->nullable();

            $table->string('created_by_name')->nullable();
            $table->string('updated_by_name')->nullable();
            $table->string('approved_by_name')->nullable();
        });
        Schema::table('weapon_prints', function (Blueprint $table) {

            $table->string('created_by')->change();
            $table->string('updated_by')->change()->nullable();


            $table->string('created_by_name')->nullable();
            $table->string('updated_by_name')->nullable();
        });
        // Schema::table('', function (Blueprint $table) {

        //     $table->string('created_by')->change();
        //     $table->string('updated_by')->change()->nullable();
        //     $table->string('approved_by')->change()->nullable();

        //     $table->string('created_by_name')->nullable();
        //     $table->string('updated_by_name')->nullable();
        //     $table->string('approved_by_name')->nullable();
        // });
        Schema::table('employee_statuses', function (Blueprint $table) {

            $table->string('created_by')->change();


            $table->string('created_by_name')->nullable();
        });
        Schema::table('employee_attachments', function (Blueprint $table) {

            $table->string('created_by')->change();
            $table->string('updated_by')->change()->nullable();
            $table->string('approved_by')->change()->nullable();

            $table->string('created_by_name')->nullable();
            $table->string('updated_by_name')->nullable();
            $table->string('approved_by_name')->nullable();
        });
        Schema::table('vehicle_attachments', function (Blueprint $table) {

            $table->string('created_by')->change();
            $table->string('updated_by')->change()->nullable();
            $table->string('approved_by')->change()->nullable();

            $table->string('created_by_name')->nullable();
            $table->string('updated_by_name')->nullable();
            $table->string('approved_by_name')->nullable();
        });
        Schema::table('vehicle_statuses', function (Blueprint $table) {

            $table->string('created_by')->change();



            $table->string('created_by_name')->nullable();
        });
        Schema::table('weapon_statuses', function (Blueprint $table) {

            $table->string('created_by')->change();



            $table->string('created_by_name')->nullable();
        });
        Schema::table('weapon_attachments', function (Blueprint $table) {


            $table->string('created_by')->change();
            $table->string('updated_by')->change()->nullable();
            $table->string('approved_by')->change()->nullable();

            $table->string('created_by_name')->nullable();
            $table->string('updated_by_name')->nullable();
            $table->string('approved_by_name')->nullable();
        });
        // Schema::table('', function (Blueprint $table) {

        //     $table->string('created_by')->change();
        //     $table->string('updated_by')->change()->nullable();


        //     $table->string('created_by_name')->nullable();
        //     $table->string('updated_by_name')->nullable();
        // });
        Schema::table('shekari_weapons', function (Blueprint $table) {

            $table->string('created_by')->change();
            $table->string('updated_by')->change()->nullable();


            $table->string('created_by_name')->nullable();
            $table->string('updated_by_name')->nullable();
        });
        Schema::table('shekari_weapon_serial_numbers', function (Blueprint $table) {

            $table->string('created_by')->change();
            $table->string('updated_by')->change()->nullable();


            $table->string('created_by_name')->nullable();
            $table->string('updated_by_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
