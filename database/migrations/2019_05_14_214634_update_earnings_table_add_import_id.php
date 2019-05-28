<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateEarningsTableAddImportId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('earnings', function($table)
        {
            $table->unsignedInteger('import_id')->nullable()->after('space_id');
            //Foreign keys
            $table->foreign('import_id')->references('id')->on('imports');
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('spendings', function ($table) {
            // FK
            $table->dropForeign('earnings_import_id_foreign');

            $table->dropColumn('import_id');
        });
    }
}
