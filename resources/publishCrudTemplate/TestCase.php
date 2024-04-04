<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Hash;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Crée un user et le log
     *
     * @param  string  $role  Role de l'utilisateur à authentifié
     *
     * @return User
     */
    public function setUser($role = null)
    {
        $password = 'dsfdgHTlm;_4';
        $user = User::factory(['password' => Hash::make($password)])->create();

        if (!is_null($role)) {
            $user->assign($role);
        }

        $this->actingAs($user);

        return $user;
    }
}
