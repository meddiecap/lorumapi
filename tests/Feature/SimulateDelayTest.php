<?php

it('can simulate latency', function () {
    // Let's not make the delay too long for the test
    $response = $this->get('/up?latency&delay=100');

    $response->assertStatus(200);
    $response->assertSee('Application up');
    $response->assertHeader('Content-Type', 'text/html; charset=UTF-8');
    $response->assertHeader('X-Simulated-Latency');
    $response->assertHeader('X-Simulated-Latency', '100');
});
