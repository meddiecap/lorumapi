<?php

it('can simulate latency', function () {
    $response = $this->get('/up');

    $response->assertStatus(200);
    $response->assertSee('OK');
    $response->assertHeader('Content-Type', 'text/plain; charset=UTF-8');
    $response->assertHeader('X-Simulated-Latency');
    $response->assertHeader('X-Simulated-Latency', '1000');
});
