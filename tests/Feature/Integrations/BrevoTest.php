<?php


use App\Integrations\BrevoConnector;
use function PHPUnit\Framework\assertTrue;

beforeEach(function (){
    $this->brevoConnector = new BrevoConnector();
});

test('send email to gmail', function () {
    $response =  $this->brevoConnector->send("test email" , "alalfydev@gmail.com" , "test from toggar");

    assertTrue($response->successful());
});

test('send email to custom domain', function () {
    $response =  $this->brevoConnector->send("test email" , "islam@alalfy.com" , "test from toggar");

    assertTrue($response->successful());
});
