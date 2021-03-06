<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Data Wisata</title>
    <link rel="shortcut icon" href="https://media.istockphoto.com/vectors/api-icon-vector-sign-and-symbol-isolated-on-white-background-api-logo-vector-id1025651460?k=20&m=1025651460&s=170667a&w=0&h=_699JucZH9fWDfk-4PyNnFhXK--fXXxJQ0XyAgA60wk=" type="image/x-icon">

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
        .card {
        border: none;
        }

        .card:hover {
            color: black;
            /* box-shadow: 5px 10px #474a4ecf; */
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }
    </style>
  </head>
  <body>
    <div class="container text-center pading">
        <h1>Data Wisata</h1>
        <a href="/ictapi">Back to ICT API</a>
        <p class="mt-3">Latihan get data wisata dari API ICT</p>
    </div>

    <div class="card container mt-4 py-4 px-5">
        <table class="table table-striped">
            <thead class="text-center">
                <tr class="tbl">
                    <th scope="col">#</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Nama Wisata</th>
                    <th scope="col">Waktu Buka</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Kota</th>
                    <th scope="col">Provinsi</th>
                    <th scope="col">Latitude</th>
                    <th scope="col">Longitude</th>
                </tr>
            </thead>
            <tbody class="text-center ">
                @foreach ($response as $wisata)
                <tr class="tbl">
                    <td>{{$wisata['id']}}</td>
                    <td><img width="150px" class="rounded" src="{{$wisata['image']}}" alt=""></td>
                    <td>{{$wisata['nama_wisata']}}</td>
                    <td>{{$wisata['waktu_buka']}}</td>
                    <td>Rp. {{number_format($wisata['harga'])}}</td>
                    <td>{{$wisata['kota']}}</td>
                    <td>{{$wisata['provinsi']}}</td>
                    <td>{{$wisata['latitude']}}</td>
                    <td>{{$wisata['longitude']}}</td>
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
