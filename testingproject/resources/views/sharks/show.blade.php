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
                    <h3>User Profile</h3>
                </div>
                <div class="">
                    <a href="{{ route('user.edit',$user->id) }}"><button class="btn btn-primary"><i class="fa fa-edit"></i> Edit</button></a>
                </div>
            </div>
            <hr class="my-1 mb-2">
            <div class="row">
                <div class="col-4">
                    <div class="border p-1 text-center">
                        <img src="{{ asset('user.png') }}" alt="user image" width="120">
                    </div>
                </div>
                <div class="col-8">
                    <h6>General Information</h6>
                    <hr class="my-1">
                    <div class="d-flex justify-content-between">
                        <label class="">Name :</label>
                        <span class="text-primary">{{ $user->name }}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <label class="">Email Id :</label>
                        <span class="text-primary">{{ $user->email }}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <label class="">Password :</label>
                        <span class="text-primary">{{ $user->password }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
