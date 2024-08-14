<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
    <div class="d-flex justify-content-center p-2 m-2">
        <div class="card p-2 w-50">
            <div class="d-flex justify-content-between">
                <div class="">
                    <h3>Users List</h3>
                </div>
                <div class="">
                    <a href="{{ route('user.create') }}"><button class="btn btn-primary"><i class="fa fa-plus"></i> New User</button></a>
                </div>
            </div>
            <hr class="my-1">
            <div class="">
                @if (\Session::has('msg'))
                <div class="text-success  text-center ">
                    <h6 style=" text-align:center !important;"><b>Success! </b>{!! \Session::get('msg') !!}</h6>
                </div>
                @endif
                @if(isset($users) && count($users))
                <table class="table table-bordered " >
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="d-flex">
                                <a class="mx-1" href="{{ route('user.show' ,$user->id) }}"><button class="btn fa fa-eye text-success"></button></a>
                                <a class="mx-1" href="{{ route('user.edit', $user->id) }}"><button class="btn fa fa-edit text-primary"></button></a>
                                <form action="{{ route('user.destroy', $user->id ) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                <button type="submit" class=" btn fa fa-trash text-danger" onclick="return confirm('Are you sure to delete this user?')"></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    <h2 class="text-center align-items-center my-2">No Data Available</h2>
                @endif
            </div>
        </div>
    </div>
</body>

</html>
