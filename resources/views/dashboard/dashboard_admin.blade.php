@extends('layouts.admin')

@section('content')

    <div class="flex items-center justify-between mb-8">
        <h3 class="text-2xl font-black text-gray-950 tracking-tight">Fitur Aplikasi</h3>
    </div>

    <div class="grid grid-cols-2 gap-8 px-2">

        <a href="{{ route('satpam.index') }}" class="group text-center">
            <div
                class="w-28 h-28 mx-auto bg-white rounded-[32px] border border-gray-100 shadow-lg shadow-gray-100 flex items-center justify-center mb-4 transition-all group-hover:border-figmaRed">
                <div class="w-14 h-14 bg-gray-50 rounded-2xl flex items-center justify-center text-figmaRed">
                    <i class="fas fa-user-gear text-3xl"></i>
                </div>
            </div>
            <p class="text-xs font-bold text-gray-950 leading-tight">Kelola akun<br>Satpam</p>
        </a>

        <a href="{{ route('keluhan.index') }}" class="group text-center">
            <div
                class="w-28 h-28 mx-auto bg-white rounded-[32px] border border-gray-100 shadow-lg shadow-gray-100 flex items-center justify-center mb-4 transition-all group-hover:border-figmaRed">
                <div class="w-14 h-14 bg-gray-50 rounded-2xl flex items-center justify-center text-figmaRed">
                    <i class="fas fa-thumbs-down text-3xl"></i>
                </div>
            </div>
            <p class="text-xs font-bold text-gray-950 leading-tight">Keluhan</p>
        </a>

    </div>
@endsection
