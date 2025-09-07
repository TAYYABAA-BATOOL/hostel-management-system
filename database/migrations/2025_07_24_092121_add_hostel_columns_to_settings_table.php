<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
{
    Schema::table('settings', function (Blueprint $table) {
        $table->string('hostel_name')->nullable();
        $table->string('contact_email')->nullable();
        $table->string('contact_phone')->nullable();
        // aur bhi fields agar hain to woh bhi yahan add karo
    });
}

public function down(): void
{
    Schema::table('settings', function (Blueprint $table) {
        $table->dropColumn(['hostel_name', 'contact_email', 'contact_phone']);
    });
}

};
