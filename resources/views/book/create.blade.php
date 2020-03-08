@extends('layout.app')
@section('scripts')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css"
        rel="stylesheet">
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

@endsection
@section('content')
    <div class="text-center">
        <h1>Add new appointment</h1>
    </div>
    <div class="row justify-content-center">
        <form>
            <div class="form-group">
                <div style="position: relative">
                    <label for="time">Time:</label>
                    <input class="timepicker form-control" name="time" id="time" type="text">
                </div>
                <script type="text/javascript">
                    $('.timepicker').datetimepicker({
                        format: 'HH:mm'
                    });
                </script>
            </div>
            <div class="form-group">
                <div style="position: relative">
                    <label for="date">Date:</label>
                    <input class="datepicker form-control" name="date" id="date" type="text" required>
                </div>
                <script type="text/javascript">
                    $('.datepicker').datetimepicker({
                        format: 'DD-MM-YYYY'
                    });
                </script>
            </div>
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name">
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name">
            </div>
            <div class="form-group">
                <label for="egn">EGN</label>
                <input type="text" class="form-control" id="egn" name="egn" placeholder="EGN">
            </div>
            <div class="form-group">
                <label for="description" class="d-block">Description</label>
                <textarea name="description" id="description" cols="30" rows="5"></textarea>
            </div>
            <div class="form-group">
                <input type="button" class="btn btn-success btn-submit" value="Add">
            </div>
        </form>
    </div>
    <script>

        $(".btn-submit").click(function (e) {
            e.preventDefault();
            let time = $("input[name=time]").val();
            let date = $("input[name=date]").val();
            let first_name = $("input[name=first_name]").val();
            let last_name = $("input[name=last_name]").val();
            let egn = $("input[name=egn]").val();
            let description = $("textarea[name=description]").val();

            $.ajax({
                type: 'POST',
                url: '{{route('book.store')}}',
                data: {
                    time: time,
                    date: date,
                    first_name: first_name,
                    last_name: last_name,
                    egn: egn,
                    description: description,
                    _token: '{{ csrf_token() }}'
                },

                success: function (data) {
                    $("input[name=time]").val('');
                    $("input[name=date]").val('');
                    $("input[name=first_name]").val('');
                    $("input[name=last_name]").val('');
                    $("input[name=egn]").val('');
                    $("textarea[name=description]").val('');
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
@endsection
