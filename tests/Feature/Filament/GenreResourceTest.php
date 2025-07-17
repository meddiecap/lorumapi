<?php

use App\Filament\Resources\GenreResource;
use App\Filament\Resources\GenreResource\Pages\CreateGenre;
use App\Filament\Resources\GenreResource\Pages\EditGenre;
use App\Filament\Resources\GenreResource\Pages\ListGenres;
use App\Models\Genre;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    actingAs($this->user);
});

it('can render the genre list page', function () {
    $response = $this->get('/admin/genres');
    $response->assertOk();
});

it('can create a genre via filament', function () {
    Livewire::test(CreateGenre::class)
        ->fillForm([
            'name' => 'Thriller',
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    expect(Genre::where('name', 'Thriller')->exists())->toBeTrue();
});

it('can update a genre via filament form', function () {
    $genre = Genre::factory()->create(['name' => 'Drama']);

    Livewire::test(EditGenre::class, ['record' => $genre->getKey()])
        ->fillForm([
            'name' => 'Science Fiction',
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    expect($genre->refresh()->name)->toBe('Science Fiction');
});


it('can bulk delete genres via filament', function () {
    $genres = Genre::factory()->count(2)->create();

    Livewire::test(ListGenres::class)
        ->callTableBulkAction('delete', $genres->pluck('id')->toArray());

    foreach ($genres as $genre) {
        expect(Genre::find($genre->id))->toBeNull();
    }
});
