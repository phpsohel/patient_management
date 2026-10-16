
<x-app-layout>
    <div class="min-h-screen bg-slate-50 py-10">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="mb-8">
                <a href="{{ route('patients.index') }}"
                   class="mb-4 inline-flex items-center gap-2 text-sm
                          font-medium text-slate-500 hover:text-indigo-600">
                    <svg class="h-4 w-4" fill="none"
                         stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2"
                              d="M15 19l-7-7 7-7"/>
                    </svg>
                    Back to Patients
                </a>

                <div class="flex items-center gap-4">
                    <div class="flex h-14 w-14 items-center
                                justify-center rounded-2xl
                                bg-indigo-100 text-indigo-600">
                        <svg class="h-7 w-7" fill="none"
                             stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round" stroke-width="1.8"
                                  d="M12 20h9 M16.5 3.5a2.1 2.1 0 0 1 3 3L9 17l-4 1 1-4Z"/>
                        </svg>
                    </div>

                    <div>
                        <h1 class="text-3xl font-bold tracking-tight
                                   text-slate-900">
                            Edit Patient
                        </h1>
                        <p class="mt-1 text-sm text-slate-500">
                            Update patient information and contact details.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Patient Summary --}}
            <div class="mb-6 flex items-center gap-4 rounded-2xl
                        border border-indigo-100 bg-indigo-50/70 p-5">
                <div class="flex h-12 w-12 items-center justify-center
                            rounded-full bg-indigo-100 text-lg
                            font-bold uppercase text-indigo-700">
                    {{ substr($patient->name, 0, 1) }}
                </div>

                <div>
                    <p class="font-semibold text-slate-900">
                        {{ $patient->name }}
                    </p>
                    <p class="mt-1 text-sm text-slate-500">
                        Patient ID: #{{ $patient->id }}
                    </p>
                </div>

                <span class="ml-auto rounded-full bg-white px-3 py-1
                             text-xs font-semibold text-indigo-700
                             ring-1 ring-indigo-200">
                    Editing
                </span>
            </div>

            {{-- Form Card --}}
            <div class="overflow-hidden rounded-2xl border
                        border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-200 px-6 py-5 sm:px-8">
                    <h2 class="text-lg font-bold text-slate-800">
                        Patient Information
                    </h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Update the fields below and save your changes.
                    </p>
                </div>

                {{-- Validation Errors --}}
                @if ($errors->any())
                    <div class="mx-6 mt-6 rounded-xl border
                                border-rose-200 bg-rose-50 p-4 sm:mx-8">
                        <p class="text-sm font-semibold text-rose-800">
                            Please fix the following errors:
                        </p>

                        <ul class="mt-2 list-inside list-disc space-y-1
                                   text-sm text-rose-700">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST"
                      action="{{ route('patients.update', $patient) }}"
                      class="space-y-6 p-6 sm:p-8">

                    @csrf
                    @method('PUT')

                    {{-- Name and Phone --}}
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div>
                            <label for="name"
                                   class="mb-2 block text-sm font-semibold
                                          text-slate-700">
                                Patient Name <span class="text-rose-500">*</span>
                            </label>

                            <input type="text" id="name" name="name"
                                   value="{{ old('name', $patient->name) }}"
                                   placeholder="Enter patient name" required
                                   class="w-full rounded-xl border
                                          border-slate-200 bg-slate-50
                                          px-4 py-3 text-sm text-slate-800
                                          placeholder:text-slate-400
                                          focus:border-indigo-500
                                          focus:bg-white focus:outline-none
                                          focus:ring-4 focus:ring-indigo-100
                                          @error('name') border-rose-400 @enderror">

                            @error('name')
                                <p class="mt-1 text-xs text-rose-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="phone"
                                   class="mb-2 block text-sm font-semibold
                                          text-slate-700">
                                Phone Number <span class="text-rose-500">*</span>
                            </label>

                            <input type="tel" id="phone" name="phone"
                                   value="{{ old('phone', $patient->phone) }}"
                                   placeholder="Enter phone number" required
                                   class="w-full rounded-xl border
                                          border-slate-200 bg-slate-50
                                          px-4 py-3 text-sm text-slate-800
                                          placeholder:text-slate-400
                                          focus:border-indigo-500
                                          focus:bg-white focus:outline-none
                                          focus:ring-4 focus:ring-indigo-100
                                          @error('phone') border-rose-400 @enderror">

                            @error('phone')
                                <p class="mt-1 text-xs text-rose-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    {{-- Email and Age --}}
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div>
                            <label for="email"
                                   class="mb-2 block text-sm font-semibold
                                          text-slate-700">
                                Email Address
                            </label>

                            <input type="email" id="email" name="email"
                                   value="{{ old('email', $patient->email) }}"
                                   placeholder="patient@example.com"
                                   class="w-full rounded-xl border
                                          border-slate-200 bg-slate-50
                                          px-4 py-3 text-sm text-slate-800
                                          placeholder:text-slate-400
                                          focus:border-indigo-500
                                          focus:bg-white focus:outline-none
                                          focus:ring-4 focus:ring-indigo-100
                                          @error('email') border-rose-400 @enderror">

                            @error('email')
                                <p class="mt-1 text-xs text-rose-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="age"
                                   class="mb-2 block text-sm font-semibold
                                          text-slate-700">
                                Age
                            </label>

                            <input type="number" id="age" name="age"
                                   value="{{ old('age', $patient->age) }}"
                                   min="0" max="150"
                                   placeholder="Enter age"
                                   class="w-full rounded-xl border
                                          border-slate-200 bg-slate-50
                                          px-4 py-3 text-sm text-slate-800
                                          placeholder:text-slate-400
                                          focus:border-indigo-500
                                          focus:bg-white focus:outline-none
                                          focus:ring-4 focus:ring-indigo-100
                                          @error('age') border-rose-400 @enderror">

                            @error('age')
                                <p class="mt-1 text-xs text-rose-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    {{-- Gender --}}
                    <div>
                        <label for="gender"
                               class="mb-2 block text-sm font-semibold
                                      text-slate-700">
                            Gender <span class="text-rose-500">*</span>
                        </label>

                        <select id="gender" name="gender" required
                                class="w-full rounded-xl border
                                       border-slate-200 bg-slate-50
                                       px-4 py-3 text-sm text-slate-700
                                       focus:border-indigo-500
                                       focus:bg-white focus:outline-none
                                       focus:ring-4 focus:ring-indigo-100
                                       @error('gender') border-rose-400 @enderror">
                            <option value="">Select gender</option>

                            <option value="male"
                                @selected(old('gender', $patient->gender) === 'male')>
                                Male
                            </option>

                            <option value="female"
                                @selected(old('gender', $patient->gender) === 'female')>
                                Female
                            </option>

                            <option value="other"
                                @selected(old('gender', $patient->gender) === 'other')>
                                Other
                            </option>
                        </select>

                        @error('gender')
                            <p class="mt-1 text-xs text-rose-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Address --}}
                    <div>
                        <label for="address"
                               class="mb-2 block text-sm font-semibold
                                      text-slate-700">
                            Full Address
                        </label>

                        <textarea id="address" name="address" rows="4"
                                  placeholder="Enter full address..."
                                  class="w-full resize-y rounded-xl border
                                         border-slate-200 bg-slate-50
                                         px-4 py-3 text-sm text-slate-800
                                         placeholder:text-slate-400
                                         focus:border-indigo-500
                                         focus:bg-white focus:outline-none
                                         focus:ring-4 focus:ring-indigo-100
                                         @error('address') border-rose-400 @enderror">{{ old('address', $patient->address) }}</textarea>

                        @error('address')
                            <p class="mt-1 text-xs text-rose-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Buttons --}}
                    <div class="flex flex-col-reverse gap-3 border-t
                                border-slate-100 pt-6 sm:flex-row
                                sm:justify-end">

                        <a href="{{ route('patients.index') }}"
                           class="inline-flex items-center justify-center
                                  rounded-xl border border-slate-200
                                  bg-white px-6 py-3 text-sm font-semibold
                                  text-slate-600 transition hover:bg-slate-50">
                            Cancel
                        </a>

                        <button type="submit"
                                class="inline-flex items-center
                                       justify-center gap-2 rounded-xl
                                       bg-indigo-600 px-6 py-3 text-sm
                                       font-semibold text-black shadow-sm
                                       transition hover:bg-indigo-700
                                       focus:outline-none focus:ring-4
                                       focus:ring-indigo-200">
                            <svg class="h-5 w-5" fill="none"
                                 stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round" stroke-width="2"
                                      d="M5 13l4 4L19 7"/>
                            </svg>
                            Update Patient
                        </button>
                    </div>

                </form>
            </div>

            <p class="mt-6 text-center text-xs text-slate-400">
                Patient Management System
            </p>

        </div>
    </div>
</x-app-layout>
