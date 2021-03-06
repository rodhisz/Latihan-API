<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Data Login My API</title>
    <link rel="shortcut icon" href="https://media.istockphoto.com/vectors/api-icon-vector-sign-and-symbol-isolated-on-white-background-api-logo-vector-id1025651460?k=20&m=1025651460&s=170667a&w=0&h=_699JucZH9fWDfk-4PyNnFhXK--fXXxJQ0XyAgA60wk=" type="image/x-icon">

    <style>
        .pading{
            padding-top: 100px
        }

        .custom{
            padding-top: 20px;
            width: 40%;
        }
        .card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        max-width: 300px;
        margin: auto;
        text-align: center;
        }

        .title {
        color: grey;
        font-size: 20px;
        }

        button {
        border: none;
        outline: 0;
        display: inline-block;
        padding: 8px;
        color: white;
        background-color: #000;
        text-align: center;
        cursor: pointer;
        width: 100%;
        font-size: 18px;
        }

        button:hover, a:hover {
        opacity: 0.7;
        }
        .halo{
            font-size: 20px;
        }
    </style>
  </head>
  <body>
    <div class="container text-center pading">
        <h1>Data Login</h1>
        <a href="/myapi">Back to My API</a>
        <p class="mt-3">Data login user dari API Sendiri</p>
    </div>

    <div class="container custom">
        <p class="halo text-center">{{$response['pesan']}}</p>
        <div class="card">
            <img src="https://media.istockphoto.com/photos/japanese-male-businessman-working-from-home-in-plain-clothes-picture-id1275746020?b=1&k=20&m=1275746020&s=170667a&w=0&h=DDZBhVjGsZ-FFdrTXZHk1WvA_vakmB8oD_s4C0l3BK0=" alt="John" style="width:100%">
            <h2 class="mt-3">{{$response['data']['name']}}</h2>
            <p class="title">{{$response['data']['email']}}</p>
            <p>Alamat : {{$response['data']['alamat']}}</p>
            <p>Telp : {{$response['data']['telp']}}</p>
            <p>Your ID : {{$response['data']['id']}}</p>
        </div>

        <a class="btn btn primary card" href="{{route('editapi', $response['data']['id'])}}">Edit Profile</a>
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
