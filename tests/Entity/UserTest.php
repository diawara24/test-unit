<?php

namespace App\Tests\Entity;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserTest extends KernelTestCase
{
    public function testUserEntity(): void
    {
        $user = new User();
        $roles = array("ROLE_ADMIN");
        $user->setFirstName("Faty");
        $user->setLastName("Diawara");
        $user->setEmail("test@test.org");
        $user->setPassword("passer");
        $user->setRoles($roles);

        $this->assertEquals('test@test.org',$user->getEmail());
        $this->assertEquals("passer", $user->getPassword()); 

        $this->assertSame("Diawara", $user->getLastName()); 

        $this->assertIsArray($user->getRoles());
        
       
    }
}
