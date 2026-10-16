<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientApiController extends Controller
{
    public function index()
    {
       $search = request('search');

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

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20', 'unique:patients,phone'],
            'email' => ['nullable', 'email'],
            'age' => ['nullable', 'integer', 'min:0', 'max:120'],
            'gender' => ['required', 'in:male,female,other'],
            'address' => ['nullable', 'string'],
        ]);

        $data['user_id'] = $request->user()->id;

        $patient = Patient::create($data);

        return response()->json($patient, 201);
    }

    public function show(Patient $patient)
    {
        return response()->json($patient);
    }

    public function update(Request $request, Patient $patient)
    {
        $data = $request->validate([
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'phone' => [
                'sometimes', 'required', 'string', 'max:20',
                \Illuminate\Validation\Rule::unique('patients', 'phone')
                    ->ignore($patient->id),
            ],
            'email' => ['sometimes', 'nullable', 'email'],
            'age' => ['sometimes', 'nullable', 'integer', 'min:0', 'max:120'],
            'gender' => ['sometimes', 'required', 'in:male,female,other'],
            'address' => ['sometimes', 'nullable', 'string'],
        ]);

        $patient->update($data);

        return response()->json($patient);
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();

        return response()->json([
            'message' => 'Patient deleted successfully.',
        ]);
    }
}
