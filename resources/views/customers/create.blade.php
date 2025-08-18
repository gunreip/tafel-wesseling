@extends('layouts.app')
@section('title','Kunde anlegen')
@section('content')
  <div class="flex items-center justify-between gap-3 mb-6">
    <h1 class="text-2xl font-semibold">Kunde anlegen</h1>
    <a href="{{ route('customers.index') }}" class="btn">Zur Liste</a>
  </div>

  <form action="#" method="post" onsubmit="return false;" class="grid gap-6 md:grid-cols-2">
    <div>
      <label class="label"><span class="label-text">Kundennummer</span></label>
      <input name="customerNo" class="input input-bordered w-full" placeholder="TW-000123" autocomplete="off">
    </div>
    <div class="md:col-span-2">
      <label class="label"><span class="label-text">E-Mail</span></label>
      <input name="email" type="email" class="input input-bordered w-full" placeholder="kunde@example.de" autocomplete="off" inputmode="email" autocapitalize="none" spellcheck="false">
    </div>
    <div>
      <label class="label"><span class="label-text">Vorname</span></label>
      <input name="firstName" class="input input-bordered w-full" placeholder="Max" autocomplete="off">
    </div>
    <div>
      <label class="label"><span class="label-text">Nachname</span></label>
      <input name="lastName" class="input input-bordered w-full" placeholder="Mustermann" autocomplete="off">
    </div>
    <div>
      <label class="label"><span class="label-text">Telefon</span></label>
      <input name="phone" class="input input-bordered w-full" placeholder="+49 …" autocomplete="off" inputmode="tel">
    </div>
    <div>
      <label class="label"><span class="label-text">Geburtsdatum</span></label>
      <input name="birthDate" type="date" class="input input-bordered w-full">
    </div>
    <div>
      <label class="label"><span class="label-text">Geburtsort</span></label>
      <input name="birthCityName" class="input input-bordered w-full" placeholder="Wesseling" autocomplete="off">
    </div>
    <div>
      <label class="label"><span class="label-text">Geburtsland (ISO-2)</span></label>
      <input name="birthCountryIso2" class="input input-bordered w-full" placeholder="DE" maxlength="2" autocapitalize="characters">
    </div>
    <div class="md:col-span-2">
      <label class="label"><span class="label-text">Notizen</span></label>
      <textarea name="notes" class="textarea textarea-bordered w-full" rows="4" placeholder="Interne Hinweise …"></textarea>
    </div>
    <div class="md:col-span-2 flex gap-3">
      <button class="btn btn-primary" type="submit">Speichern (Stub)</button>
      <a href="{{ route('customers.index') }}" class="btn btn-ghost">Abbrechen</a>
    </div>
  </form>
@endsection
