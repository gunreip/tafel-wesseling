@extends('layouts.app')
@section('title','Kunde bearbeiten')
@section('content')
  <div class="flex items-center justify-between gap-3 mb-6">
    <h1 class="text-2xl font-semibold">Kunde bearbeiten</h1>
    <a href="{{ route('customers.show',['customer'=>$customerId ?? '—']) }}" class="btn btn-ghost">Zurück</a>
  </div>

  <form action="#" method="post" onsubmit="return false;" class="grid gap-6 md:grid-cols-2">
    <div>
      <label class="label"><span class="label-text">Kundennummer</span></label>
      <input name="customerNo" class="input input-bordered w-full" value="{{ $customerId ?? '' }}" autocomplete="off">
    </div>
    <div class="md:col-span-2">
      <label class="label"><span class="label-text">E-Mail</span></label>
      <input name="email" type="email" class="input input-bordered w-full" placeholder="kunde@example.de" autocomplete="off" inputmode="email" autocapitalize="none" spellcheck="false">
    </div>
    <div>
      <label class="label"><span class="label-text">Vorname</span></label>
      <input name="firstName" class="input input-bordered w-full" autocomplete="off">
    </div>
    <div>
      <label class="label"><span class="label-text">Nachname</span></label>
      <input name="lastName" class="input input-bordered w-full" autocomplete="off">
    </div>
    <div class="md:col-span-2 flex gap-3">
      <button class="btn btn-primary" type="submit">Speichern (Stub)</button>
      <a href="{{ route('customers.index') }}" class="btn btn-ghost">Abbrechen</a>
    </div>
  </form>
@endsection
