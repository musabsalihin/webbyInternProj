<?php

use App\Models\User;
use Laravel\Jetstream\Http\Livewire\UpdateProfileInformationForm;
use Livewire\Livewire;

test('current profile information is available', function () {
    $this->actingAs($user = User::factory()->create());

    $component = Livewire::test(UpdateProfileInformationForm::class);

    expect($component->state['name'])->toEqual($user->name);
    expect($component->state['email'])->toEqual($user->email);
});

test('profile information can be updated', function () {
    $this->actingAs($user = User::factory()->create());
    $data = [
        'name' => fake()->name,
        'email' => fake()->unique()->safeEmail(),
    ];
    Livewire::test(UpdateProfileInformationForm::class)
        ->set('state', ['name' => $data['name'], 'email' => $data['email']])
        ->call('updateProfileInformation');

    expect($user->fresh())
        ->name->toEqual($data['name'])
        ->email->toEqual($data['email']);
});
