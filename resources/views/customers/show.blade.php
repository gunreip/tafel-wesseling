@extends('layouts.app')
@section('title','Kunde – Details')
@section('content')
  <div class="flex items-center justify-between gap-3 mb-6">
    <h1 class="text-2xl font-semibold">Kunde – Details</h1>
    <div class="flex gap-2">
      <a href="{{ route('customers.edit',['customer'=>$customerId ?? '—']) }}" class="btn">Bearbeiten</a>
      <a href="{{ route('customers.index') }}" class="btn btn-ghost">Zur Liste</a>
    </div>
  </div>

  <div class="grid gap-4 md:grid-cols-2">
    <div class="card border p-4">
      <h2 class="font-semibold mb-2">Stammdaten</h2>
      <div class="space-y-1 text-sm">
        <div><span class="opacity-60">Kundennummer:</span> <span>{{ $customerId ?? '—' }}</span></div>
        <div><span class="opacity-60">Name:</span> <span>—</span></div>
        <div><span class="opacity-60">E-Mail:</span> <span>—</span></div>
        <div><span class="opacity-60">Status:</span> <span class="badge">aktiv</span></div>
      </div>
    </div>
    <div class="card border p-4">
      <h2 class="font-semibold mb-2">Kontakt</h2>
      <div class="space-y-1 text-sm">
        <div><span class="opacity-60">Telefon:</span> —</div>
        <div><span class="opacity-60">Geburtsdatum:</span> —</div>
        <div><span class="opacity-60">Geburtsort:</span> —</div>
        <div><span class="opacity-60">Geburtsland:</span> —</div>
      </div>
    </div>
  </div>
@endsection
