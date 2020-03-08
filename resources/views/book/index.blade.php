@extends('layout.app')

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

@endsection

@section('content')
    <h1 class="text-center">Appointments</h1>
    <div class="justify-content-center">
        <div class="row">
            <div class="col-md-4 text-center font-weight-bold">Date / Hour</div>
            <div class="col-md-2 text-center font-weight-bold">Client</div>
        </div>
        @foreach($appointments as $appointment)
            <div class="text-center item">
                <div class="row text-center">
                    <div class="col-md-4">{{date('H:i d-M-Y', strtotime($appointment->date))}}</div>
                    <div class="col-md-2">{{$appointment->first_name}}  {{$appointment->last_name}}</div>
                    <div class="col-md-1 m-1"><a class="btn btn-success"
                                                 href="{{route('book.show', [$appointment->id])}}">More</a>
                    </div>
                    <div class="col-md-1 m-1"><a class="btn btn-info"
                                                 href="{{route('book.edit', [$appointment->id])}}">Edit</a>
                    </div>
                    <div class="col-md-1 m-1">
                        <form>
                            <input type="button" class="btn btn-danger" id="remove{{$appointment->id}}" value="Remove">
                        </form>
                        <script>
                            $("#remove{{$appointment->id}}").click(function (e) {
                                e.preventDefault();

                                $.ajax({
                                    type: 'DELETE',
                                    url: '{{route('book.destroy', [$appointment->id])}}',
                                    data: {
                                        _token: '{{ csrf_token() }}'
                                    },
                                    success: function (data) {
                                        $("#remove{{$appointment->id}}").closest('.item').remove();
                                        $('#messages').html('');
                                        $('#messages').append('<div class="alert alert-success">' + data.success +
                                            '<button type="button" class="close" data-dismiss="alert">×</button>' +
                                            '<div>');
                                    },
                                    error: function (data) {
                                        $('#messages').html('');
                                        $.each(data.responseJSON.errors, function (key, value) {
                                            $('#messages').append('<div class="alert alert-danger">' + value +
                                                '<button type="button" class="close" data-dismiss="alert">×</button>' +
                                                '</div>');
                                        });
                                    },
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="row">
            {{$appointments->links()}}
        </div>
    </div>

@endsection
