<?php

use App\Filament\Resources\CustomerResource;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\{actingAs, assertAuthenticated, get, post, put, delete};

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    actingAs($this->user);
});

it('shows the customer index page', function () {
    $this->get(CustomerResource::getUrl())->assertSuccessful();
});
