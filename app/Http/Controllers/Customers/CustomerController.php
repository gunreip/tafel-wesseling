<?php
// /home/gunreip/code/tafel-wesseling/app/Http/Controllers/Customers/CustomerController.php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{

    public function index(Request $request)
    {
        $query = \App\Models\Customer::query()->select(['customer_no', 'first_name', 'last_name', 'email']);

        if ($request->filled('last_name')) {
            // Exact-Match via Blind-Index (z. B. last_name_eq)
            $query->whereBlind('last_name', 'last_name_eq', $request->string('last_name'));
        }
        if ($request->filled('email')) {
            $query->whereBlind('email', 'email_eq', $request->string('email'));
        }
        $customers = $query->paginate(15);

        return view('admin.customers.index', compact('customers'));
    }

    public function create()
    {
        return view('admin.customers.create');
    }

    public function store(Request $request)
    {
        // Validierung (sichtbare Texte Deutsch)
        $validated = $request->validate(
            [
                'customer_no' => [
                    'required',
                    'string',
                    'max:50',
                    Rule::unique('customers', 'customer_no'),
                ],
                'first_name'  => ['required', 'string', 'max:100'],
                'last_name'   => ['required', 'string', 'max:100'],
                'email'       => ['nullable', 'email', 'max:255'],
            ],
            [
                'customer_no.required' => 'Die Kundennummer ist erforderlich.',
                'customer_no.unique'   => 'Die Kundennummer ist bereits vergeben.',
                'first_name.required'  => 'Der Vorname ist erforderlich.',
                'last_name.required'   => 'Der Nachname ist erforderlich.',
                'email.email'          => 'Bitte eine gültige E‑Mail-Adresse eingeben.',
            ]
        );

        // Anlage: CipherSweet verschlüsselt last_name/email automatisch
        $customer = Customer::create($validated);

        return redirect()
            ->route('admin.customers.index', ['q_customer_no' => $customer->customer_no])
            ->with('status', 'Kunde erfolgreich angelegt.');
    }
}
