<?php

it('can simulate latency', function () {
    $response = $this->get('/up?latency&delay=1000');

    $response->assertStatus(200);
    $response->assertSee('Application up');
    $response->assertHeader('Content-Type', 'text/html; charset=UTF-8');
    $response->assertHeader('X-Simulated-Latency');
    $response->assertHeader('X-Simulated-Latency', '1000');
});
