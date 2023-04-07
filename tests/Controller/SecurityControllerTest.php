<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    private function signUp($email, $password) {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');
        
        $this->assertPageTitleSame('Log in');

        $buttonCrawlerNode = $crawler->selectButton('Sign in');

        $form = $buttonCrawlerNode->form();

        $form['email'] = $email;
        $form['password'] = $password;

        $client->submit($form);
        
        $crawler = $client->followRedirect();
    }
    
    public function testLoginForm() {
        $this->signUp('faty@email.fr', 'passer');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('a', 'Se déconnecter');
    }

    public function testBadCredentials() {
        $this->signUp('faty@email.fr', 'passe');
        $this->assertSelectorTextContains('div.alert.alert-danger', 'Invalid credentials');
    }
}
