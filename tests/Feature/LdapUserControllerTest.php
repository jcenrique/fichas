<?php

namespace Tests\Feature;

use App\Ldap\User;
use LdapRecord\Laravel\Testing\DirectoryEmulator;
use Tests\TestCase;

class LdapUserControllerTest extends TestCase
{
    public function test_index_works()
    {
        DirectoryEmulator::setup('default');

        $user = User::create([
            'cn' => 'John Doe',
            'samaccountname' => 'jdoe',
        ]);

        $this->assertEquals('cn=John Doe,dc=ets,dc=local', $user->getDn());

        $this->get('/ldap/users')
            ->assertSee($user->getFirstAttribute('cn'))
            ->assertSee($user->getFirstAttribute('samaccountname'));
    }
}