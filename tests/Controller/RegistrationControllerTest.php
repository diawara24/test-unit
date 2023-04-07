<?php

namespace App\Tests\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrationControllerTest extends WebTestCase
{
    public function testRegistrationForm() {
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);

        $crawler = $client->request('GET', '/register');

        $this->assertPageTitleContains('Register');

        $buttonCrawlerNode = $crawler->selectButton('Register');

        $form = $buttonCrawlerNode->form();

        $form['registration_form[firstName]'] = 'Talla';
        $form['registration_form[lastName]'] = 'Faty';
        $form['registration_form[email]'] = 'faty@test.test';
        $form['registration_form[plainPassword]'] = 'passer';

        $client->submit($form); 
       
        $testUser = $userRepository->findOneByEmail('faty@test.test');
        $this->assertSame("Faty", $testUser->getLastName()); 

        $this->assertIsArray($testUser->getRoles());

        $this->assertResponseRedirects('/');

        $crawler = $client->followRedirect();
        $this->assertSelectorTextContains('a', 'Se déconnecter');
    }
}
