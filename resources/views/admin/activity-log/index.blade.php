@extends('layouts.app')

@section('title', 'Änderungsverlauf')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-semibold mb-4">Änderungsverlauf</h1>

    {{-- Filterleiste --}}
    <form method="get" class="grid grid-cols-1 md:grid-cols-6 gap-3 mb-4">
        <div>
            <label class="block text-sm mb-1">Log-Name</label>
            <select name="log_name" class="w-full border rounded p-2">
                <option value="">– alle –</option>
                @foreach($logNames as $name)
                    <option value="{{ $name }}" @selected($filters['logName'] === $name)>{{ $name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm mb-1">Benutzer-ID</label>
            <input name="causer_id" value="{{ $filters['causerId'] }}" class="w-full border rounded p-2" placeholder="z. B. 1">
        </div>
        <div>
            <label class="block text-sm mb-1">Objekt-Typ</label>
            <input name="subject_type" value="{{ $filters['subjectType'] }}" class="w-full border rounded p-2" placeholder="z. B. App\Models\Customer">
        </div>
        <div>
            <label class="block text-sm mb-1">Objekt-ID</label>
            <input name="subject_id" value="{{ $filters['subjectId'] }}" class="w-full border rounded p-2" placeholder="z. B. 42">
        </div>
        <div>
            <label class="block text-sm mb-1">Suche</label>
            <input name="q" value="{{ $filters['q'] }}" class="w-full border rounded p-2" placeholder="Beschreibung/Details">
        </div>
        <div class="flex gap-2">
            <div class="flex-1">
                <label class="block text-sm mb-1">Von</label>
                <input type="date" name="date_from" value="{{ $filters['dateFrom'] }}" class="w-full border rounded p-2">
            </div>
            <div class="flex-1">
                <label class="block text-sm mb-1">Bis</label>
                <input type="date" name="date_to" value="{{ $filters['dateTo'] }}" class="w-full border rounded p-2">
            </div>
        </div>
        <div class="md:col-span-6 flex gap-2">
            <button class="px-3 py-2 rounded bg-black text-white">Filtern</button>
            <a href="{{ route('admin.history.index') }}" class="px-3 py-2 rounded border">Zurücksetzen</a>
        </div>
    </form>

    {{-- Tabelle --}}
    <div class="overflow-x-auto bg-white border rounded">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="text-left p-2">Zeitpunkt</th>
                    <th class="text-left p-2">Benutzer</th>
                    <th class="text-left p-2">Aktion</th>
                    <th class="text-left p-2">Log-Name</th>
                    <th class="text-left p-2">Objekt</th>
                    <th class="text-left p-2">Details</th>
                </tr>
            </thead>
            <tbody>
                @forelse($activities as $a)
                    <tr class="border-t">
                        <td class="p-2 whitespace-nowrap">
                            {{ optional($a->created_at)->timezone('Europe/Berlin')->format('d.m.Y H:i:s') }}
                        </td>
                        <td class="p-2">
                            @if($a->causer)
                                {{ method_exists($a->causer, 'name') ? $a->causer->name : ('User #'.$a->causer_id) }}
                            @else
                                <em>System</em>
                            @endif
                        </td>
                        <td class="p-2">{{ $a->description }}</td>
                        <td class="p-2">{{ $a->log_name }}</td>
                        <td class="p-2">
                            @if($a->subject)
                                {{ class_basename($a->subject_type) }} #{{ $a->subject_id }}
                            @else
                                {{ class_basename($a->subject_type) }} #{{ $a->subject_id }} <em>(gelöscht?)</em>
                            @endif
                        </td>
                        <td class="p-2 max-w-[420px]">
                            @php
                                $props = $a->properties?->toArray();
                                $pretty = $props ? json_encode($props, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT) : '';
                            @endphp
                            @if($pretty)
                                <details>
                                    <summary class="cursor-pointer underline">anzeigen</summary>
                                    <pre class="mt-1 text-xs whitespace-pre-wrap">{{ $pretty }}</pre>
                                </details>
                            @else
                                <span class="text-gray-500">–</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-4 text-center text-gray-500">Keine Einträge gefunden.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $activities->links() }}
    </div>
</div>
@endsection
