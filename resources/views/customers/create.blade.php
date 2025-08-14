{{-- /home/gunreip/code/tafel-wesseling/resources/views/admin/customers/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Kunde anlegen')

@section('content')
<div class="mb-6">
  <h1 class="text-2xl font-semibold">Kunde anlegen</h1>
  <p class="text-base-content/60">Bitte die Felder ausfüllen. Nachname/E‑Mail werden verschlüsselt gespeichert.</p>
</div>

@if ($errors->any())
  <div class="alert alert-error mb-4">
    <ul class="list-disc list-inside">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<form method="POST" action="{{ route('customers.store') }}" class="space-y-4 max-w-2xl">
  @csrf

  <div class="grid md:grid-cols-2 gap-4">
    <div>
      <label class="label"><span class="label-text">Kundennummer</span></label>
      <input type="text" name="customer_no" value="{{ old('customer_no') }}" class="input input-bordered w-full" required>
    </div>
    <div>
      <label class="label"><span class="label-text">Vorname</span></label>
      <input type="text" name="first_name" value="{{ old('first_name') }}" class="input input-bordered w-full" required>
    </div>
  </div>

  <div class="grid md:grid-cols-2 gap-4">
    <div>
      <label class="label"><span class="label-text">Nachname</span></label>
      <input type="text" name="last_name" value="{{ old('last_name') }}" class="input input-bordered w-full" required>
    </div>
    <div>
      <label class="label"><span class="label-text">E‑Mail</span></label>
      <input type="email" name="email" value="{{ old('email') }}" class="input input-bordered w-full">
    </div>
  </div>

  <div class="flex items-center gap-3">
    <button class="btn btn-primary">@svg('lucide-save', 'w-4 h-4 mr-2') Speichern</button>
    <a href="{{ route('customers.index') }}" class="btn btn-ghost">Abbrechen</a>
  </div>
</form>
@endsection
