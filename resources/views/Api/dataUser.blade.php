<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Kumpulan Doa Harian</title>

    <style>
        .pading{
            padding-top: 100px
        }
        .pd{
            padding-top: 50px;
            padding-bottom: 100px
        }
        .tbl{
            vertical-align: middle;
        }
    </style>
  </head>
  <body>
    <div class="container text-center pading">
        <h1>Data User</h1>
        <a href="/publicapi">Back to Public API</a>
        <p class="mt-3">Latihan get data "kumpulan doa-doa harian" dari API Public</p>
    </div>

    <div class="container pd">
        <table class="table">
            <thead class="text-center">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Doa</th>
                    <th scope="col">Ayat</th>
                    <th scope="col">Latin</th>
                    <th scope="col">Arti</th>
                </tr>
            </thead>
            <tbody class="text-center ">
                @foreach ($response as $res)
                <tr class="tbl">
                    <td>{{$res['id']}}</td>
                    <td><strong>{{$res['doa']}}</strong></td>
                    <td>{{$res['ayat']}}</td>
                    <td>{{$res['latin']}}</td>
                    <td>{{$res['artinya']}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
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
