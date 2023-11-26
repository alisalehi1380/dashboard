<?php

use App\Models\Tables\TablesName;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create(TablesName::USERS, function (Blueprint $table) {
            $table->id();
            $table->string(User::FIRST_NAME);
            $table->string(User::LAST_NAME);
            $table->string(User::MOBILE)->unique();
            $table->boolean(User::MOBILE_VERIFIED_AT)->default(false);
            $table->string(User::OTP)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(TablesName::USERS);
    }
};
