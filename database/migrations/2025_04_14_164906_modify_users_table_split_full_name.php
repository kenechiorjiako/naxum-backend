<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // First, add the new columns
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->after('password')->nullable();
            $table->string('last_name')->after('first_name')->nullable();
        });

        // Split full_name into first_name and last_name
        $users = DB::table('users')->get();
        foreach ($users as $user) {
            $names = explode(' ', $user->full_name, 2);
            $firstName = $names[0] ?? '';
            $lastName = $names[1] ?? '';
            DB::table('users')
                ->where('id', $user->id)
                ->update([
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                ]);
        }

        // Drop full_name
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('full_name');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('full_name')->after('password')->nullable();
        });

        // Combine first_name and last_name back into full_name
        $users = DB::table('users')->get();
        foreach ($users as $user) {
            $fullName = trim($user->first_name . ' ' . $user->last_name);
            DB::table('users')
                ->where('id', $user->id)
                ->update(['full_name' => $fullName]);
        }

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['first_name', 'last_name']);
        });
    }
};