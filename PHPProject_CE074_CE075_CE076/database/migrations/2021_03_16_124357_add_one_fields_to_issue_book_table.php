<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOneFieldsToIssueBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('issue__books', function (Blueprint $table) {
            //
            $table->dropColumn('time');
            $table->date('issued_date')->useCurrent=TRUE;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('issue_book', function (Blueprint $table) {
            //
        });
    }
}
