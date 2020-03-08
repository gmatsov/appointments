@extends('layout.app')

@section('content')
    <h1 class="text-center">{{$appointment->first_name}} {{$appointment->last_name}} appointment</h1>
    <div class="container text-center">
        <div>
            <span class="font-weight-bold">Time: </span> {{date('H:i d-M-Y', strtotime($appointment->date))}}
        </div>
        <div>
            <span class="font-weight-bold">Names:</span> {{$appointment->first_name}} {{$appointment->last_name}}
        </div>
        <div>
            <span class="font-weight-bold">EGN: </span>{{$appointment->egn}}</div>
        <div>
            <span class="font-weight-bold">Description: </span>{{$appointment->description}}</div>
    </div>
    @if($other_client_appointments)
        <div>
            <h4>Future appointments of this client</h4>
        </div>
        @foreach($other_client_appointments as $appointment)
            <div>{{date('H:i d-M-Y', strtotime($appointment->date))}}</div>
            <div>{{$appointment->first_name}}  {{$appointment->last_name}}</div>
            <div><a class="btn btn-info" href="{{route('book.show', $appointment->id)}}">More</a></div>

        @endforeach
    @endif
@endsection
