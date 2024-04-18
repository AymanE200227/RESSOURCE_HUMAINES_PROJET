@extends('layouts.app')

@section('title', 'Evaluate User')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Evaluate User</h5>
        </div>
        <div class="card-body">
            <p>User Name: {{ $user->name }}</p>
            <p>Work Percentage: {{ $workPercentage }}%</p>
            <p>Task Adherence: {{ $taskAdherence }}%</p>
        </div>
    </div>
</div>
@endsection
