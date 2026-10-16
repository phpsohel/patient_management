
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-bold text-gray-800">
                Dashboard
            </h2>
        </div>
    </x-slot>

    <div class="bg-gray-100">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 gap-6 md:grid-cols-4">

                {{-- Sidebar --}}
                <aside class="rounded-xl bg-slate-900 p-5 text-white shadow-sm">
                    <h3 class="mb-6 text-lg font-bold">
                        MediCare Admin
                    </h3>

                    <nav class="space-y-2">
                        <a href="{{ route('dashboard') }}"
                           class="flex items-center gap-3 rounded-lg
                           px-4 py-3 text-sm font-medium
                           {{ request()->routeIs('dashboard')
                               ? 'bg-indigo-600 text-white'
                               : 'text-slate-300 hover:bg-slate-800' }}">
                            <span>▦</span>
                            Dashboard
                        </a>

                        <p class="px-4 pb-1 pt-5 text-xs uppercase
                                  tracking-wider text-slate-400">
                            Patient Management
                        </p>

                        <a href="{{ route('patients.index') }}"
                           class="flex items-center gap-3 rounded-lg
                           px-4 py-3 text-sm font-medium
                           {{ request()->routeIs('patients.index')
                               ? 'bg-indigo-600 text-white'
                               : 'text-slate-300 hover:bg-slate-800' }}">
                            <span>♙</span>
                            All Patients
                        </a>

                        <a href="{{ route('patients.create') }}"
                           class="flex items-center gap-3 rounded-lg
                           px-4 py-3 text-sm font-medium
                           {{ request()->routeIs('patients.create')
                               ? 'bg-indigo-600 text-white'
                               : 'text-slate-300 hover:bg-slate-800' }}">
                            <span>＋</span>
                            Add Patient
                        </a>
                    </nav>
                </aside>

                {{-- Main Content --}}
                <main class="min-w-0 md:col-span-3">

                    <div class="mb-6">
                        <h1 class="text-2xl font-bold text-gray-800">
                            Welcome back!
                        </h1>
                        <p class="mt-1 text-sm text-gray-500">
                            Manage your patients from one place.
                        </p>
                    </div>

                    {{-- Statistics --}}
                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                        <div class="rounded-xl border border-gray-200
                                    bg-white p-6 shadow-sm">
                            <p class="text-sm font-medium text-gray-500">
                                Total Patients
                            </p>

                            <p class="mt-3 text-3xl font-bold text-indigo-600">
                                {{ \App\Models\Patient::count() }}
                            </p>

                            <a href="{{ route('patients.index') }}"
                               class="mt-4 inline-block text-sm font-semibold
                                      text-indigo-600 hover:text-indigo-800">
                                View all patients →
                            </a>
                        </div>

                        <div class="rounded-xl border border-gray-200
                                    bg-white p-6 shadow-sm">
                            <p class="text-sm font-medium text-gray-500">
                                Quick Action
                            </p>

                            <h3 class="mt-3 text-xl font-bold text-gray-800">
                                Register a patient
                            </h3>

                            <a href="{{ route('patients.create') }}"
                               class="mt-4 inline-flex rounded-lg
                                      bg-indigo-600 px-4 py-2.5 text-sm
                                      font-semibold text-white
                                      hover:bg-indigo-700">
                                + Add Patient
                            </a>
                        </div>

                    </div>

                    {{-- Recent Patients --}}
                    <div class="mt-6 overflow-hidden rounded-xl
                                border border-gray-200 bg-white shadow-sm">

                        <div class="flex items-center justify-between
                                    border-b border-gray-200 p-5">
                            <h3 class="font-bold text-gray-800">
                                Recent Patients
                            </h3>

                            <a href="{{ route('patients.index') }}"
                               class="text-sm font-semibold text-indigo-600">
                                View All
                            </a>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-sm">
                                <thead class="bg-gray-50 text-gray-500">
                                    <tr>
                                        <th class="px-5 py-3 font-semibold">
                                            Name
                                        </th>
                                        <th class="px-5 py-3 font-semibold">
                                            Phone
                                        </th>
                                        <th class="px-5 py-3 font-semibold">
                                            Action
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="divide-y divide-gray-100">
                                    @forelse (
                                        \App\Models\Patient::latest()->take(5)->get()
                                        as $patient
                                    )
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-5 py-4 font-medium
                                                       text-gray-800">
                                                {{ $patient->name }}
                                            </td>

                                            <td class="px-5 py-4 text-gray-600">
                                                {{ $patient->phone }}
                                            </td>

                                            <td class="px-5 py-4">
                                                <a href="{{ route('patients.edit', $patient) }}"
                                                   class="font-semibold text-indigo-600
                                                          hover:text-indigo-800">
                                                    Edit
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3"
                                                class="px-5 py-8 text-center
                                                       text-gray-500">
                                                No patients found.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                </main>
            </div>
        </div>
    </div>
</x-app-layout>
