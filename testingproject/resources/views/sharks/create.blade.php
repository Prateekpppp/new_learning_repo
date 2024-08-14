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

<style>
    label{
        font-weight: 600;
    }
</style>

</head>
<body>
    <div class="d-flex justify-content-center p-2 m-2">
        <div class="card p-2 w-50">
            <div class="d-flex justify-content-between">
                <div class="">
                    <h3>Create User</h3>
                </div>
                <div class="">
                    <a href="{{ route('user.index') }}"><button class="btn btn-primary"><i class="fa fa-list"></i> User List</button></a>
                </div>
            </div>
            <hr class="my-1">
            <form action="{{ route('user.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col">
                      <label for="">Name</label>
                      <input type="text" name="name" class="form-control" placeholder="Enter name here..">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                      <label for="">Email Id</label>
                      <input type="email" name="email" class="form-control" placeholder="Enter email here..">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                      <label for="">Passowrd</label>
                      <input type="password" name="password" class="form-control" placeholder="Enter passowrd here..">
                    </div>
                </div>
                <div class="my-2">
                    <button type="submit" class="btn btn-success w-100">Submit</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
