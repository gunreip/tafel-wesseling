<?php
// /home/gunreip/code/tafel-wesseling/app/Http/Controllers/Admin/CustomerController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        // Eingaben (intern en-US), Labels in Views auf Deutsch
        $qCustomerNo = trim((string) $request->query('q_customer_no', ''));
        $qLastName   = trim((string) $request->query('q_last_name', ''));
        $qEmail      = trim((string) $request->query('q_email', ''));

        $query = Customer::query()->orderByDesc('created_at');

        // Optional: customer_no LIKE-Filter (nicht verschlüsselt)
        if ($qCustomerNo !== '') {
            $query->where('customer_no', 'ILIKE', "%{$qCustomerNo}%");
        }

        // Exact-Match Suche über Blind-Index
        if ($qLastName !== '') {
            $query->whereBlind('last_name', 'last_name_eq', $qLastName);
        }

        if ($qEmail !== '') {
            $query->whereBlind('email', 'email_eq', $qEmail);
        }

        $customers = $query->paginate(10)->appends($request->query());

        return view('admin.customers.index', [
            'customers'   => $customers,
            'qCustomerNo' => $qCustomerNo,
            'qLastName'   => $qLastName,
            'qEmail'      => $qEmail,
        ]);
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
                    'required', 'string', 'max:50',
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
