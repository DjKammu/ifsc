<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('branches', function (Blueprint $table) {
             $table->string('state')->nullable()->after('city_id');
             $table->string('state_slug')->nullable()->after('state');
             $table->string('district')->nullable()->after('state_slug');
             $table->string('district_slug')->nullable()->after('district');
             $table->string('city')->nullable()->after('district_slug');
             $table->string('city_slug')->nullable()->after('city');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('branches', function (Blueprint $table) {
            $table->dropCoulmn('state');
            $table->dropCoulmn('state_slug');
            $table->dropCoulmn('district');
            $table->dropCoulmn('district_slug');
            $table->dropCoulmn('city');
            $table->dropCoulmn('city_slug');
        });
    }
}
