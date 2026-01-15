public function test_user_cannot_register_if_quota_is_full()
{
    $doctor = Doctor::factory()->create();
    $date = now()->addDay()->toDateString();

    // Simulasi 20 orang sudah daftar
    Queue::factory()->count(20)->create([
        'doctor_id' => $doctor->id,
        'appointment_date' => $date
    ]);

    // Coba daftar yang ke-21
    $user = User::factory()->create();
    $response = $this->actingAs($user)->post('/queue/store', [
        'doctor_id' => $doctor->id,
        'appointment_date' => $date,
        'complaint' => 'Sakit gigi parah bung'
    ]);

    $response->assertSessionHas('error', 'Maaf bung, kuota dokter ini sudah penuh (Max 20).');
    $this->assertEquals(20, Queue::where('doctor_id', $doctor->id)->count());
}
