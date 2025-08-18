@extends('layouts.app')
@section('title','Kunden')
@section('content')
  <div class="flex items-center justify-between gap-3 mb-6">
    <h1 class="text-2xl font-semibold">Kunden</h1>
    <a href="{{ route('customers.create') }}" class="btn btn-primary">Neu anlegen</a>
  </div>

  <form class="grid gap-4 md:grid-cols-3 mb-6" action="#" method="get" onsubmit="return false;">
    <div>
      <label class="label" for="q_customer_no"><span class="label-text">Kundennummer</span></label>
      <input id="q_customer_no" name="customerNo" class="input input-bordered w-full" placeholder="z. B. TW-000123" autocomplete="off">
    </div>
    <div>
      <label class="label" for="q_last_name"><span class="label-text">Nachname</span></label>
      <input id="q_last_name" name="lastName" class="input input-bordered w-full" placeholder="Mustermann" autocomplete="off">
    </div>
    <div>
      <label class="label" for="q_email"><span class="label-text">E-Mail</span></label>
      <input id="q_email" name="email" type="email" class="input input-bordered w-full" placeholder="kunde@example.de" autocomplete="off" inputmode="email" autocapitalize="none" spellcheck="false">
    </div>
    <div class="md:col-span-3">
      <button type="submit" class="btn">Suchen</button>
      <button type="reset" class="btn btn-ghost">Zurücksetzen</button>
    </div>
  </form>

  <div class="overflow-x-auto">
    <table class="table table-zebra">
      <thead>
        <tr><th>Kundennr.</th><th>Name</th><th>E-Mail</th><th>Status</th><th class="text-right">Aktionen</th></tr>
      </thead>
      <tbody>
        <tr>
          <td>—</td><td>—</td><td>—</td><td><span class="badge">aktiv</span></td>
          <td class="text-right">
            <a href="{{ route('customers.show',['customer'=>'demo']) }}" class="btn btn-ghost btn-xs">Details</a>
            <a href="{{ route('customers.edit',['customer'=>'demo']) }}" class="btn btn-ghost btn-xs">Bearbeiten</a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
@endsection
