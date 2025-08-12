{{-- /home/gunreip/code/tafel-wesseling/resources/views/admin/activitylog/index.blade.php --}}
@extends('layouts.admin.admin-layout')

@section('title', 'Aktivitäten')
@section('page_heading', 'Aktivitäten')

@section('breadcrumbs')
<ul>
    <li><a href="{{ route('admin.dashboard') }}">Admin</a></li>
    <li class="text-primary">Aktivitäten</li>
</ul>
@endsection

@section('content')
    <div class="flex items-center gap-2 mb-4">
        <x-lucide-clipboard-list class="w-5 h-5"/>
        <span class="font-medium">Letzte Ereignisse</span>
    </div>

    <div class="overflow-x-auto">
        <table class="table table-zebra">
            <thead>
                <tr>
                    <th>Zeitpunkt</th>
                    <th>Ereignis</th>
                    <th>Benutzer</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>—</td>
                    <td>—</td>
                    <td>—</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
