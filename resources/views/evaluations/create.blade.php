@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-center">
            <div class="w-full md:w-3/4 lg:w-1/2">
                <div class="bg-white shadow-md rounded-lg">
                    <div class="bg-gray-200 px-4 py-2 rounded-t-lg">
                        <h5 class="text-lg font-semibold">Créer une évaluation</h5>
                    </div>

                    <div class="p-6">
                        <form method="POST" action="{{ route('evaluations.store') }}">
                            @csrf

                            <div class="mb-4">
                                <label for="employee_id" class="block font-medium">Employé</label>
                                <select name="employee_id" id="employee_id" class="form-select mt-1 block w-full">
                                    @foreach($employees as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="criteria" class="block font-medium">Critères</label>
                                <div id="criteria">
                                    <div class="criteria-item mb-2">
                                        <input type="text" name="criteria[0][name]" class="form-input mt-1 w-full" placeholder="Nom du critère" required>
                                        <input type="text" name="criteria[0][goal]" class="form-input mt-1 w-full" placeholder="Objectif" required>
                                    </div>
                                </div>
                                <button type="button" id="add-criterion" class="btn btn-sm btn-primary">Ajouter un critère</button>
                            </div>

                            <button type="submit" class="btn btn-primary">Soumettre</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('add-criterion').addEventListener('click', function() {
            const criteriaDiv = document.getElementById('criteria');
            const criteriaCount = criteriaDiv.children.length;
            const newCriterion = document.createElement('div');
            newCriterion.classList.add('criteria-item', 'mb-2');
            newCriterion.innerHTML = `
                <input type="text" name="criteria[${criteriaCount}][name]" class="form-input mt-1 w-full" placeholder="Nom du critère" required>
                <input type="text" name="criteria[${criteriaCount}][goal]" class="form-input mt-1 w-full" placeholder="Objectif" required>
            `;
            criteriaDiv.appendChild(newCriterion);
        });
    </script>
@endsection
