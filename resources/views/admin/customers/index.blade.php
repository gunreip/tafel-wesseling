{{-- /home/gunreip/code/tafel-wesseling/resources/views/admin/customers/index.blade.php --}}
@extends('layouts.admin.app')

@section('title', 'Kunden')

@section('content')
<div class="flex items-center justify-between mb-6">
  <h1 class="text-2xl font-semibold">Kunden</h1>
  <a href="{{ route('admin.customers.create') }}" class="btn btn-primary">
    @svg('lucide-plus', 'w-4 h-4 mr-2') Neuer Kunde
  </a>
</div>

@if (session('status'))
  <div class="alert alert-success mb-4">
    {{ session('status') }}
  </div>
@endif

<form method="GET" action="{{ route('admin.customers.index') }}" class="grid md:grid-cols-4 gap-3 mb-5">
  <div>
    <label class="label"><span class="label-text">Kundennummer</span></label>
    <input type="text" name="q_customer_no" value="{{ $qCustomerNo }}" class="input input-bordered w-full" placeholder="z. B. DEV-0001">
  </div>
  <div>
    <label class="label"><span class="label-text">Nachname (exakt)</span></label>
    <input type="text" name="q_last_name" value="{{ $qLastName }}" class="input input-bordered w-full" placeholder="Mustermann">
  </div>
  <div>
    <label class="label"><span class="label-text">E‑Mail (exakt)</span></label>
    <input type="text" name="q_email" value="{{ $qEmail }}" class="input input-bordered w-full" placeholder="max@example.test">
  </div>
  <div class="flex items-end">
    <button class="btn btn-outline w-full">@svg('lucide-search', 'w-4 h-4 mr-2') Suchen</button>
  </div>
</form>

<div class="overflow-x-auto rounded-2xl shadow">
  <table class="table w-full">
    <thead>
      <tr>
        <th class="w-40">Kundennr.</th>
        <th>Vorname</th>
        <th>Nachname</th>
        <th>E‑Mail</th>
        <th>Erstellt</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($customers as $c)
        <tr>
          <td class="font-mono">{{ $c->customer_no }}</td>
          <td>{{ $c->first_name }}</td>
          <td>{{ $c->last_name }}</td>
          <td>{{ $c->email }}</td>
          <td><span class="text-sm text-base-content/60">{{ $c->created_at?->format('d.m.Y H:i') }}</span></td>
        </tr>
      @empty
        <tr>
          <td colspan="5" class="text-center text-base-content/60 py-6">Keine Einträge gefunden.</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>

<div class="mt-4">
  {{ $customers->links() }}
</div>
@endsection
