<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des patients</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f4f7fb;
            color: #1f2937;
        }

        .page {
            max-width: 1000px;
            margin: 40px auto;
            padding: 20px;
        }

        .card {
            background: #ffffff;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            margin-bottom: 24px;
        }

        h1, h2 {
            margin-top: 0;
            color: #0f766e;
        }

        .top-links {
            margin-bottom: 16px;
        }

        .top-links a {
            color: #0f766e;
            text-decoration: none;
            font-weight: bold;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            box-sizing: border-box;
        }

        button, .button-link {
            display: inline-block;
            padding: 10px 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }

        .primary {
            background: #0f766e;
            color: #ffffff;
        }

        .secondary {
            background: #e2e8f0;
            color: #1f2937;
        }

        .warning {
            background: #d97706;
            color: #ffffff;
        }

        .danger {
            background: #dc2626;
            color: #ffffff;
        }

        .success-message {
            padding: 12px;
            margin-bottom: 16px;
            background: #dcfce7;
            color: #166534;
            border-radius: 8px;
        }

        .error-box {
            padding: 12px;
            margin-bottom: 16px;
            background: #fee2e2;
            color: #991b1b;
            border-radius: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border-bottom: 1px solid #e2e8f0;
            padding: 12px;
            text-align: left;
        }

        .actions {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .inline-form {
            display: inline;
        }
    </style>
</head>
<body>
    <div class="page">
        <div class="top-links">
            <a href="{{ route('home') }}">Retour a l'accueil</a>
        </div>

        <div class="card">
            <h1>{{ $patientToEdit ? 'Modifier un patient' : 'Enregistrer un patient' }}</h1>

            <p>
                Remplissez le formulaire ci-dessous pour ajouter un patient.
                Si vous cliquez sur "Modifier" dans le tableau, ce meme formulaire
                servira a mettre les informations a jour.
            </p>

            @if (session('success'))
                <div class="success-message">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="error-box">
                    <strong>Veuillez corriger les erreurs suivantes :</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ $patientToEdit ? route('patients.update', $patientToEdit) : route('patients.store') }}">
                @csrf
                @if ($patientToEdit)
                    @method('PUT')
                @endif

                <label for="nom">Nom</label>
                <input
                    type="text"
                    id="nom"
                    name="nom"
                    value="{{ old('nom', $patientToEdit?->nom) }}"
                    placeholder="Entrez le nom"
                >

                <label for="prenom">Prenom</label>
                <input
                    type="text"
                    id="prenom"
                    name="prenom"
                    value="{{ old('prenom', $patientToEdit?->prenom) }}"
                    placeholder="Entrez le prenom"
                >

                <label for="age">Age</label>
                <input
                    type="number"
                    id="age"
                    name="age"
                    value="{{ old('age', $patientToEdit?->age) }}"
                    placeholder="Entrez l'age"
                >

                <label for="maladie">Maladie</label>
                <input
                    type="text"
                    id="maladie"
                    name="maladie"
                    value="{{ old('maladie', $patientToEdit?->maladie) }}"
                    placeholder="Entrez la maladie"
                >

                <button type="submit" class="primary">
                    {{ $patientToEdit ? 'Mettre a jour' : 'Enregistrer' }}
                </button>

                @if ($patientToEdit)
                    <a href="{{ route('patients.index') }}" class="button-link secondary">Annuler</a>
                @endif
            </form>
        </div>

        <div class="card">
            <h2>Liste des patients</h2>

            @if ($patients->isEmpty())
                <p>Aucun patient n'a encore ete enregistre.</p>
            @else
                <table>
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Age</th>
                            <th>Maladie</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($patients as $patient)
                            <tr>
                                <td>{{ $patient->nom }}</td>
                                <td>{{ $patient->prenom }}</td>
                                <td>{{ $patient->age }}</td>
                                <td>{{ $patient->maladie }}</td>
                                <td class="actions">
                                    <a href="{{ route('patients.edit', $patient) }}" class="button-link warning">Modifier</a>

                                    <form method="POST" action="{{ route('patients.destroy', $patient) }}" class="inline-form">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="danger"
                                            onclick="return confirm('Voulez-vous vraiment supprimer ce patient ?')"
                                        >
                                            Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</body>
</html>
