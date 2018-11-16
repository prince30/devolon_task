<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTableMigration extends Migration
{
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('station_count')->default(0);
            $table->integer('parent_id')->unsigned()->nullable();
            $table->integer('position', false, true);
            $table->integer('real_depth', false, true);
            $table->softDeletes();

            $table->foreign('parent_id')
                ->references('id')
                ->on('companies')
                ->onDelete('set null');
        });

        Schema::create('company_closure', function (Blueprint $table) {
            $table->increments('closure_id');

            $table->integer('ancestor', false, true);
            $table->integer('descendant', false, true);
            $table->integer('depth', false, true);

            $table->foreign('ancestor')
                ->references('id')
                ->on('companies')
                ->onDelete('cascade');

            $table->foreign('descendant')
                ->references('id')
                ->on('companies')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('company_closure', function (Blueprint $table) {
            Schema::dropIfExists('company_closure');
        });

        Schema::table('companies', function (Blueprint $table) {
            Schema::dropIfExists('companies');
        });
    }
}
