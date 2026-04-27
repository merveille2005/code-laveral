<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PatientController extends Controller
{
    public function home(): View
    {
        return view('home');
    }

    public function index(): View
    {
        return view('patients.form', [
            'patients' => Patient::latest()->get(),
            'patientToEdit' => null,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        // Validation simple des donnees envoyees par le formulaire.
        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'age' => ['required', 'integer', 'min:0', 'max:120'],
            'maladie' => ['required', 'string', 'max:255'],
        ]);

        // Creation du patient en base de donnees.
        Patient::create($validated);

        return redirect()
            ->route('patients.index')
            ->with('success', 'Patient ajoute avec succes.');
    }

    public function edit(Patient $patient): View
    {
        return view('patients.form', [
            'patients' => Patient::latest()->get(),
            'patientToEdit' => $patient,
        ]);
    }

    public function update(Request $request, Patient $patient): RedirectResponse
    {
        // On reutilise presque la meme validation que pour l'ajout.
        $validated = $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'age' => ['required', 'integer', 'min:0', 'max:120'],
            'maladie' => ['required', 'string', 'max:255'],
        ]);

        $patient->update($validated);

        return redirect()
            ->route('patients.index')
            ->with('success', 'Patient modifie avec succes.');
    }

    public function destroy(Patient $patient): RedirectResponse
    {
        $patient->delete();

        return redirect()
            ->route('patients.index')
            ->with('success', 'Patient supprime avec succes.');
    }
}
