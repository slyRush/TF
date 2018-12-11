<?php

namespace App\Tests;

//use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Panther\PantherTestCase;

/**
 * Class NewsControllerTest
 * @package App\Tests
 */
class NewsControllerTest extends PantherTestCase
{
    /**
     * Test news
     */
    public function testNews()
    {
        $client = static::createPantherClient();
        $crawler = $client->request('GET', '/news');

        $this->assertCount(1, $crawler->filter('h1'));
//        $this->assertSame('Attentat à paris', $crawler->filter('tbody > tr > td')->eq(1));

        /*$link = $crawler->selectLink('Join us at SymfonyLive USA 2018!')->link();
        $crawler = $client->click($link);

        $this->assertSame('Join us at SymfonyLive USA 2018!', $crawler->filter('h1')->text());*/
    }
}
