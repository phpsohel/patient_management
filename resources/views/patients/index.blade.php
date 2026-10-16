
<x-app-layout>
    <div class="min-h-screen bg-slate-50 py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            {{-- Page Header --}}
            <div class="mb-8 flex flex-col gap-4 sm:flex-row
                        sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-3xl font-bold tracking-tight
                               text-slate-900">
                        Patient Management
                    </h1>
                    <p class="mt-2 text-sm text-slate-500">
                        Manage patient records, contact details
                        and information.
                    </p>
                </div>

                <a href="{{ route('patients.create') }}"
                   class="inline-flex items-center justify-center
                          gap-2 rounded-xl bg-indigo-600 px-5 py-3
                          text-sm font-semibold text-black shadow-sm
                          transition hover:bg-indigo-700
                          focus:outline-none focus:ring-2
                          focus:ring-indigo-500 focus:ring-offset-2">
                    <svg class="h-5 w-5" fill="none"
                         stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2"
                              d="M12 4v16m8-8H4"/>
                    </svg>
                    Add New Patient
                </a>
            </div>

            {{-- Success Message --}}
            @if (session('success'))
                <div class="mb-6 flex items-center gap-3 rounded-xl
                            border border-emerald-200 bg-emerald-50
                            px-5 py-4 text-sm font-medium
                            text-emerald-700">
                    <svg class="h-5 w-5 shrink-0" fill="none"
                         stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2"
                              d="m5 12 4 4L19 6"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            {{-- Search Card --}}
            <div class="mb-6 rounded-2xl border border-slate-200
                        bg-white p-5 shadow-sm">
                <form method="GET"
                      action="{{ route('patients.index') }}"
                      class="flex flex-col gap-3 sm:flex-row">

                    <div class="relative flex-1">
                        <svg class="absolute left-3 top-1/2
                                    h-5 w-5 -translate-y-1/2
                                    text-slate-400"
                             fill="none" stroke="currentColor"
                             viewBox="0 0 24 24">
                            <circle cx="11" cy="11" r="7"
                                    stroke-width="2"/>
                            <path stroke-linecap="round"
                                  stroke-width="2"
                                  d="m16 16 4 4"/>
                        </svg>

                        <input
                            type="text"
                            name="search"
                            value="{{ $search }}"
                            placeholder="Search by patient name or phone..."
                            class="w-full rounded-xl border
                                   border-slate-200 bg-slate-50
                                   py-3 pl-10 pr-4 text-sm
                                   text-slate-700 placeholder:text-slate-400
                                   focus:border-indigo-500
                                   focus:bg-white focus:outline-none
                                   focus:ring-2 focus:ring-indigo-100"
                        >
                    </div>

                    <button type="submit"
                            class="rounded-xl bg-slate-900 px-6 py-3
                                   text-sm font-semibold text-white
                                   transition hover:bg-slate-700">
                        Search
                    </button>

                    <a href="{{ route('patients.index') }}"
                       class="rounded-xl border border-slate-200
                              px-6 py-3 text-center text-sm
                              font-semibold text-slate-600
                              transition hover:bg-slate-50">
                        Reset
                    </a>
                </form>
            </div>

            {{-- Patient Table --}}
            <div class="overflow-hidden rounded-2xl border
                        border-slate-200 bg-white shadow-sm">

                <div class="flex flex-col gap-1 border-b
                            border-slate-200 px-6 py-5 sm:flex-row
                            sm:items-center sm:justify-between">
                    <h2 class="text-lg font-bold text-slate-900">
                        All Patients
                    </h2>
                    <p class="text-sm text-slate-500">
                        {{ $patients->total() }} patient(s) found
                    </p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full min-w-[700px] text-left">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-4 text-xs font-bold
                                           uppercase tracking-wider
                                           text-slate-500">
                                    Patient
                                </th>
                                <th class="px-6 py-4 text-xs font-bold
                                           uppercase tracking-wider
                                           text-slate-500">
                                    Phone
                                </th>
                                <th class="px-6 py-4 text-xs font-bold
                                           uppercase tracking-wider
                                           text-slate-500">
                                    Email Address
                                </th>
                                <th class="px-6 py-4 text-right text-xs
                                           font-bold uppercase
                                           tracking-wider text-slate-500">
                                    Actions
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100">
                            @forelse ($patients as $patient)
                                <tr class="transition hover:bg-slate-50">

                                    {{-- Patient Name --}}
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="flex h-10 w-10
                                                        shrink-0 items-center
                                                        justify-center rounded-full
                                                        bg-indigo-100 text-sm
                                                        font-bold uppercase
                                                        text-indigo-700">
                                                {{ substr($patient->name, 0, 1) }}
                                            </div>

                                            <div>
                                                <p class="font-semibold
                                                          text-slate-800">
                                                    {{ $patient->name }}
                                                </p>
                                                <p class="mt-1 text-xs
                                                          text-slate-400">
                                                    Patient ID: #{{ $patient->id }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Phone --}}
                                    <td class="whitespace-nowrap px-6 py-4
                                               text-sm text-slate-600">
                                        {{ $patient->phone ?: 'Not provided' }}
                                    </td>

                                    {{-- Email --}}
                                    <td class="px-6 py-4 text-sm
                                               text-slate-600">
                                        {{ $patient->email ?: 'Not provided' }}
                                    </td>

                                    {{-- Actions --}}
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div class="flex items-center
                                                    justify-end gap-2">
                                            <a href="{{ route('patients.edit', $patient) }}"
                                               class="rounded-lg border
                                                      border-indigo-200
                                                      bg-indigo-50 px-3 py-2
                                                      text-xs font-semibold
                                                      text-indigo-700
                                                      transition hover:bg-indigo-100">
                                                Edit
                                            </a>

                                            <form method="POST"
                                                  action="{{ route('patients.destroy', $patient) }}"
                                                  onsubmit="return confirm('Are you sure you want to delete this patient?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="rounded-lg border
                                                               border-rose-200
                                                               bg-rose-50 px-3 py-2
                                                               text-xs font-semibold
                                                               text-rose-700
                                                               transition hover:bg-rose-100">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-16
                                                           text-center">
                                        <div class="mx-auto flex h-14 w-14
                                                    items-center justify-center
                                                    rounded-full bg-slate-100">
                                            <svg class="h-7 w-7
                                                        text-slate-400"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 viewBox="0 0 24 24">
                                                <circle cx="9" cy="8" r="4"
                                                        stroke-width="2"/>
                                                <path stroke-linecap="round"
                                                      stroke-width="2"
                                                      d="M3 21v-2a6 6 0 0 1 12 0v2
                                                         M19 8v6m3-3h-6"/>
                                            </svg>
                                        </div>

                                        <h3 class="mt-4 text-base font-bold
                                                   text-slate-800">
                                            No patients found
                                        </h3>
                                        <p class="mt-1 text-sm text-slate-500">
                                            Try another search or add a new patient.
                                        </p>

                                        <a href="{{ route('patients.create') }}"
                                           class="mt-4 inline-block text-sm
                                                  font-semibold text-indigo-600
                                                  hover:text-indigo-800">
                                            + Add your first patient
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if ($patients->hasPages())
                    <div class="border-t border-slate-200
                                bg-white px-6 py-4">
                        {{ $patients->appends(request()->query())->links() }}
                    </div>
                @endif

            </div>

            <p class="mt-5 text-center text-xs text-slate-400">
                Patient Management System
            </p>
        </div>
    </div>
</x-app-layout>
