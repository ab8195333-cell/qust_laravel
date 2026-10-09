<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up()
{
    Schema::table('questions', function (Blueprint $table) {
        // إضافة عمود البلاغات بقيمة افتراضية صفر
        $table->integer('reports')->default(0);
    });
}

public function down()
{
    Schema::table('questions', function (Blueprint $table) {
        // حذف العمود في حال تراجعنا عن العملية
        $table->dropColumn('reports');
    });
}
};
