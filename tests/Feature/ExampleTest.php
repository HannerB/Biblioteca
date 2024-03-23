<?php

use App\Models\User;

it('returns a successful response', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

test('admin can see reports', function () {
    // Creamos un usuario administrador
    $adminUser = User::factory()
        ->administrator()
        ->create();

    // Nos logueamos con el usuario administrador
    $response = $this->actingAs($adminUser);

    // Nos vamos a la ruta "/reports" y esperamos que
    // la petición sea correcta
    $response->get('/reports')
        ->assertOk();
});

test('teacher cannot see reports', function () {
    $teacherUser = User::factory()
        ->teacher()
        ->create();

    $this->actingAs($teacherUser)
        ->get('/reports')
        ->assertForbidden();
});

test('teacher can register attendance', function () {
    $teacherUser = User::factory()
        ->teacher()
        ->create();

    $this->actingAs($teacherUser)
        ->get('/register-attendance')
        ->assertOk();
});

test('admin cannot register attendance', function () {
    $adminUser = User::factory()
        ->administrator()
        ->create();

    $this->actingAs($adminUser)
        ->get('/register-attendance')
        ->assertForbidden();
});
