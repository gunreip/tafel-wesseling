@extends('layouts.app')

@section('title','Kunden')

@section('content')
  <div class="flex items-center justify-between mb-4">
    <h1 class="text-xl font-semibold">Kunden</h1>
    <a href="{{ route('customers.create') }}" class="btn">Neu</a>
  </div>

  <form method="GET" action="{{ route('customers.index') }}" class="mb-4 flex gap-2">
    <input type="text" name="last_name" placeholder="Nachname (Exact-Match)"
           value="{{ request('last_name') }}" class="border rounded px-2 py-1">
    <input type="text" name="email" placeholder="E-Mail (Exact-Match)"
           value="{{ request('email') }}" class="border rounded px-2 py-1">
    <button class="px-3 py-2 border rounded">Suchen</button>
  </form>

  <div class="table-box bg-white border">
    <table class="text-sm">
      <thead class="bg-gray-100">
        <tr>
          <th class="text-left p-2">Kunden-Nr.</th>
          <th class="text-left p-2">Vorname</th>
          <th class="text-left p-2">Nachname</th>
          <th class="text-left p-2">E-Mail</th>
        </tr>
      </thead>
      <tbody>
        @forelse($customers as $customer)
          <tr class="border-t">
            <td class="p-2">{{ $customer->customer_no }}</td>
            <td class="p-2">{{ $customer->first_name }}</td>
            <td class="p-2">{{ $customer->last_name }}</td>  {{-- entschlüsselt via Cast --}}
            <td class="p-2">{{ $customer->email }}</td>       {{-- entschlüsselt via Cast --}}
          </tr>
        @empty
          <tr><td class="p-2" colspan="4">Keine Kunden gefunden.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="mt-3">
    {{ $customers->links() }}
  </div>
@endsection
