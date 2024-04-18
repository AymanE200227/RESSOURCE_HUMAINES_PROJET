@extends('layouts.app')

@section('title')
    Create a user | @parent
@stop

@section('content')
    <div class="card">
        <div class="card-header bg-green-500">
            <h4 class="title text-white">Create a new user</h4>
            <p class="category text-white">Create an employee or another manager</p>
        </div>
        <div class="card-content">
            <form action="{{ route('users.store') }}" method="post">
                @csrf
                @include('workUsers.form')
                <button type="submit" class="btn btn-default">Create</button>
            </form>
        </div>
    </div>
@stop
