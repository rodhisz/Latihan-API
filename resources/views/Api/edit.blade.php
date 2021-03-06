<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Edit My API</title>
    <link rel="shortcut icon" href="https://media.istockphoto.com/vectors/api-icon-vector-sign-and-symbol-isolated-on-white-background-api-logo-vector-id1025651460?k=20&m=1025651460&s=170667a&w=0&h=_699JucZH9fWDfk-4PyNnFhXK--fXXxJQ0XyAgA60wk=" type="image/x-icon">

    <style>
        .pading{
            padding-top: 100px
        }

        .custom{
            padding-top: 20px;
            width: 40%;
        }
    </style>
  </head>
  <body>
    <div class="container text-center pading">
        <h1>Edit User from My API</h1>
        <a href="/myapi">Back to My API</a>
        <p class="mt-3">Latihan Edit user dari API Sendiri</p>
    </div>

    <div class="container custom">

        <form action="{{route('edituserapi', $response['result']['id'])}}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Name</label>
                <input type="name" name="name" class="form-control" value="{{ $response['result']['name'] }}" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" value="{{ $response['result']['email'] }}" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Alamat</label>
                <input type="alamat" name="alamat" class="form-control" value="{{ $response['result']['alamat'] }}" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Telp</label>
                <input type="telp" name="telp" class="form-control" value="{{ $response['result']['telp'] }}" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Photo</label>
                <input type="photo" name="photo" class="form-control" value="{{ $response['result']['photo'] }}" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>
