@extends('layouts.app')

@section('title')
    Enter new work | @parent
@stop

@section('content')
    <div class="card">
        <div class="card-header" data-background-color="green">
            <h4 class="title">Enter new work</h4>
            <p class="category">Enter work that you have done for a project</p>
        </div>
        <div class="card-content">
            <form action="{{ route('works.store') }}" method="post">
                @csrf
                @include('works.form')

                <!-- Display projects dropdown -->
                <div class="form-group">
                    <label for="project">Project</label>
                    <select name="project" id="project" class="form-control">
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}">{{ $project->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-default">Create</button>
            </form>
        </div>
    </div>
@stop
