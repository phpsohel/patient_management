<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $patients = Patient::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('phone', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('patients.index', compact('patients', 'search'));
    }

    public function create()
    {
        return view('patients.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => ['required', 'string', 'max:255'],
            'phone'   => ['required', 'string', 'max:20', 'unique:patients,phone'],
            'email'   => ['nullable', 'email', 'max:255'],
            'age'     => ['nullable', 'integer', 'min:0', 'max:120'],
            'gender'  => ['required', Rule::in(['male', 'female', 'other'])],
            'address' => ['nullable', 'string', 'max:2000'],
        ]);

        $data['user_id'] = $request->user()->id;

        Patient::create($data);

        return redirect()->route('patients.index')
            ->with('success', 'Patient created successfully.');
    }

    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient)
    {
        $data = $request->validate([
            'name'    => ['required', 'string', 'max:255'],
            'phone'   => [
                'required', 'string', 'max:20',
                Rule::unique('patients', 'phone')->ignore($patient->id),
            ],
            'email'   => ['nullable', 'email', 'max:255'],
            'age'     => ['nullable', 'integer', 'min:0', 'max:120'],
            'gender'  => ['required', Rule::in(['male', 'female', 'other'])],
            'address' => ['nullable', 'string', 'max:2000'],
        ]);

        $patient->update($data);

        return redirect()->route('patients.index')
            ->with('success', 'Patient updated successfully.');
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();

        return redirect()->route('patients.index')
            ->with('success', 'Patient deleted successfully.');
    }
}
