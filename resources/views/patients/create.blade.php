
<x-app-layout>
    <div class="min-h-screen bg-slate-50 py-10">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">

            {{-- Page Header --}}
            <div class="mb-8">
                <a href="{{ route('patients.index') }}"
                   class="mb-4 inline-flex items-center gap-2 text-sm
                          font-medium text-slate-500 transition
                          hover:text-indigo-600">
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
                                  d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2
                                     M10 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8
                                     M20 8v6m3-3h-6"/>
                        </svg>
                    </div>

                    <div>
                        <h1 class="text-3xl font-bold tracking-tight
                                   text-slate-900">
                            Add New Patient
                        </h1>
                        <p class="mt-1 text-sm text-slate-500">
                            Enter patient details to create a new record.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Form Card --}}
            <div class="overflow-hidden rounded-2xl border
                        border-slate-200 bg-white shadow-sm">

                <div class="border-b border-slate-200 px-6 py-5 sm:px-8">
                    <h2 class="text-lg font-bold text-slate-800">
                        Patient Information
                    </h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Fields marked with * are required.
                    </p>
                </div>

                {{-- Validation Errors --}}
                @if ($errors->any())
                    <div class="mx-6 mt-6 rounded-xl border
                                border-rose-200 bg-rose-50 p-4 sm:mx-8">
                        <div class="flex items-start gap-3">
                            <svg class="mt-0.5 h-5 w-5 shrink-0
                                        text-rose-600"
                                 fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round" stroke-width="2"
                                      d="M12 9v4m0 4h.01M10.3 3.9
                                         1.8 18.5A2 2 0 0 0 3.5 21h17
                                         a2 2 0 0 0 1.7-2.5L13.7 3.9
                                         a2 2 0 0 0-3.4 0z"/>
                            </svg>

                            <div>
                                <h3 class="text-sm font-semibold
                                           text-rose-800">
                                    Please fix the following errors:
                                </h3>
                                <ul class="mt-2 list-inside list-disc
                                           space-y-1 text-sm text-rose-700">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <form method="POST"
                      action="{{ route('patients.store') }}"
                      class="space-y-6 p-6 sm:p-8">
                    @csrf

                    {{-- Name and Phone --}}
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">

                        <div>
                            <label for="name"
                                   class="mb-2 block text-sm font-semibold
                                          text-slate-700">
                                Patient Name <span class="text-rose-500">*</span>
                            </label>

                            <input type="text" id="name" name="name"
                                   value="{{ old('name') }}"
                                   placeholder="Enter full name"
                                   required
                                   class="w-full rounded-xl border
                                          border-slate-200 bg-slate-50
                                          px-4 py-3 text-sm text-slate-800
                                          placeholder:text-slate-400
                                          focus:border-indigo-500
                                          focus:bg-white focus:outline-none
                                          focus:ring-4 focus:ring-indigo-100
                                          @error('name') border-rose-400 @enderror">

                            @error('name')
                                <p class="mt-1.5 text-xs text-rose-600">
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
                                   value="{{ old('phone') }}"
                                   placeholder="e.g. 01712345678"
                                   required
                                   class="w-full rounded-xl border
                                          border-slate-200 bg-slate-50
                                          px-4 py-3 text-sm text-slate-800
                                          placeholder:text-slate-400
                                          focus:border-indigo-500
                                          focus:bg-white focus:outline-none
                                          focus:ring-4 focus:ring-indigo-100
                                          @error('phone') border-rose-400 @enderror">

                            @error('phone')
                                <p class="mt-1.5 text-xs text-rose-600">
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
                                   value="{{ old('email') }}"
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
                                <p class="mt-1.5 text-xs text-rose-600">
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
                                   value="{{ old('age') }}"
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
                                <p class="mt-1.5 text-xs text-rose-600">
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
                                @selected(old('gender') === 'male')>
                                Male
                            </option>
                            <option value="female"
                                @selected(old('gender') === 'female')>
                                Female
                            </option>
                            <option value="other"
                                @selected(old('gender') === 'other')>
                                Other
                            </option>
                        </select>

                        @error('gender')
                            <p class="mt-1.5 text-xs text-rose-600">
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
                                  placeholder="Enter village, area, city or full address..."
                                  class="w-full resize-y rounded-xl border
                                         border-slate-200 bg-slate-50
                                         px-4 py-3 text-sm text-slate-800
                                         placeholder:text-slate-400
                                         focus:border-indigo-500
                                         focus:bg-white focus:outline-none
                                         focus:ring-4 focus:ring-indigo-100
                                         @error('address') border-rose-400 @enderror">{{ old('address') }}</textarea>

                        @error('address')
                            <p class="mt-1.5 text-xs text-rose-600">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Form Actions --}}
                    <div class="flex flex-col-reverse gap-3 border-t
                                border-slate-100 pt-6 sm:flex-row
                                sm:justify-end">

                        <a href="{{ route('patients.index') }}"
                           class="inline-flex items-center justify-center
                                  rounded-xl border border-slate-200
                                  bg-white px-6 py-3 text-sm font-semibold
                                  text-slate-600 transition
                                  hover:bg-slate-50">
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
                            Save Patient
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
