@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-center">
            <div class="w-full md:w-3/4 lg:w-1/2">
                <div class="bg-white shadow-md rounded-lg">
                    <div class="bg-gray-200 px-4 py-2 rounded-t-lg flex justify-between items-center">
                        <h5 class="text-lg font-semibold">Évaluations</h5>
                        <a href="{{ route('evaluations.create') }}" class="btn btn-primary btn-sm">Créer une évaluation</a>
                    </div>

                    <div class="p-6">
                        @foreach($evaluations as $evaluation)
                            <div class="mb-3">
                                <h5 class="font-semibold">Employé : {{ $evaluation->employee->name }}</h5>
                                <ul class="list-disc pl-6">
                                    @foreach($evaluation->criteria as $criterion)
                                        <li>{{ $criterion['name'] }} - Objectif : {{ $criterion['goal'] }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
