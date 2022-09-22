<!DOCTYPE html>
<html lang="en">
<head>
    <title>Guest Book</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="container mt-lg-4">
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <details>
        <summary>
            Fill Out The Guest Book
        </summary>
        <div class="card-body">
                <form name="captcha-contact-us" id="captcha-contact-us" method="post" action="{{url('captcha-validation')}}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Username*</label>
                        <input type="text" id="username" name="username" class="@error('username') is-invalid @enderror form-control">
                        @error('username')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email*</label>
                        <input type="email" id="email" name="email" class="@error('email') is-invalid @enderror form-control">
                        @error('email')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Link To The Website</label>
                        <input type="text" id="link" name="link" class="@error('link') is-invalid @enderror form-control">
                        @error('link')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Message Text*</label>
                        <textarea name="text" id="text" class="@error('text') is-invalid @enderror form-control"></textarea>
                        @error('text')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mt-4 mb-4">
                        <div class="captcha">
                            <span>{!! captcha_img() !!}</span>
                            <button type="button" class="btn btn-danger" class="reload" id="reload">
                                ↻
                            </button>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
    </details>
        <div>
            <h1 class="text-center text-uppercase">Guest Book</h1>
        </div>
<div class="align-content-center py-8">
    <table class="table-bordered ">
        <tr class="text-center text-uppercase">
            <td>Username</td>
            <td>Message Text</td>
            <td>Created At</td>
        </tr>
        @foreach ($guestBooks as $book)
            <tr>
                <td class="text-uppercase text-center">{{ $book->username }}</td>
                <td> <a href=" {{ $book->link }} " target="_blank">{{ $book->text }} </a></td>
                <td>{{ $book->created_at }}</td>
            </tr>
        @endforeach
    </table>
    {{ $guestBooks->links() }}

    <p>
        Displaying {{$guestBooks->count()}} of {{ $guestBooks->total() }} guestbook entries.
    </p>
</div>

</div>


<script type="text/javascript">
    $('#reload').click(function () {
        $.ajax({
            type: 'GET',
            url: 'reload-captcha',
            success: function (data) {
                $(".captcha span").html(data.captcha);
            }
        });
    });
</script>
</body>
</html>
