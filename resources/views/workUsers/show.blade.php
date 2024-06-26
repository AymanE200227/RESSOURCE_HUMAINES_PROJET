@extends('layouts.app')

@section('title')
    {{ $user->name }} | @parent
@stop

@section('content')
    <div class="card">
        <div class="card-header" data-background-color="green">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="title">{{ $user->name }}</h4>
                    <p class="category">Show {{ $user->name }}'s properties and changes to them</p>
                </div>
                <div class="col-sm-6 align-right">
                    <a href="/users/{{ $user->id }}/edit" class="btn btn-default">
                        <i class="material-icons">mode_edit</i>
                    </a>
                    <form action="/users/{{ $user->id }}" method="POST" class="inline-block">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="btn btn-danger">
                            <i class="material-icons">delete</i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-content">
            <div class="row">
                <div class="col-sm-2 align-right"><b>Name</b></div>
                <div class="col-sm-10">{{ $user->name }}</div>
            </div>
            <div class="row">
                <div class="col-sm-2 align-right"><b>E-Mail</b></div>
                <div class="col-sm-10">{{ $user->email }}</div>
            </div>
            <div class="row">
                <div class="col-sm-2 align-right"><b>Hourly rate</b></div>
                <div class="col-sm-10">{{ number_format($user->rate, 2) }}</div>
            </div>
            <div class="row">
                <div class="col-sm-2 align-right"><b>Is manager</b></div>
                <div class="col-sm-10">
                    <i class="material-icons">{{ $user->is_manager ? 'check' : 'close' }}</i>
                </div>
            </div>
        </div>
    </div>

    @if(Auth::user()->isManager())
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header card-chart" data-background-color="green">
                        <div class="ct-chart" id="hoursPerDayChart"></div>
                    </div>
                    <div class="card-content">
                        <h4 class="title">Hours per day</h4>
                        <p class="category">See at a glance how many hours this project had, per day, in the last
                            month</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header card-chart" data-background-color="red">
                        <div class="ct-chart" id="costPerDayChart"></div>
                    </div>
                    <div class="card-content">
                        <h4 class="title">Cost</h4>
                        <p class="category">Keep the total cost at bay</p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if(!$user->is_manager)
        <div class="card">
            <div class="card-header" data-background-color="green">
                <h4 class="title">Projects</h4>
                <p class="category">Projects to which {{ $user->name }} has access</p>
            </div>
            <div class="card-content">
                @if(count($user->projects) > 0)
                    <ul>
                        @foreach($user->projects as $project)
                            <li>{{ $project->name }}</li>
                        @endforeach
                    </ul>
                @else
                    None
                @endif
            </div>
        </div>
    @endif

    @include('audit', ['resource' => $user])
@stop

@push('scripts')
    <style>
        .card-content .row {
            margin-top: 1em;
        }
    </style>

    <script>
        /* HoursPerDayChart */
        const dataHoursPerDayChart = {
            labels: {!! json_encode($labels) !!},
            series: [
                {!! json_encode($hours) !!}
            ]
        };

        const optionsHoursPerDayChart = {
            lineSmooth: Chartist.Interpolation.cardinal({
                tension: 0
            }),
            low: 0,
            high: 24,
            chartPadding: {top: 0, right: 0, bottom: 0, left: 0}
        };

        const hoursPerDayChart = new Chartist.Line('#hoursPerDayChart', dataHoursPerDayChart, optionsHoursPerDayChart);

        md.startAnimationForLineChart(hoursPerDayChart);


        /* CostPerDayChart */
        const dataCostPerDayChart = {
            labels: {!! json_encode($labels) !!},
            series: [
                {!! json_encode($costs) !!}
            ]
        };

        const optionsCostPerDayChart = {
            lineSmooth: Chartist.Interpolation.cardinal({
                tension: 0
            }),
            low: 0,
            high: {{ $highest_cost }},
            chartPadding: {top: 0, right: 0, bottom: 0, left: 0}
        };

        const costPerDayChart = new Chartist.Line('#costPerDayChart', dataCostPerDayChart, optionsCostPerDayChart);

        md.startAnimationForLineChart(costPerDayChart);
    </script>
@endpush