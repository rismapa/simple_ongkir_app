<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ongkos Kirim</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
</head>
  <body>
    <nav class="navbar bg-body-tertiary">
        <div class="container">
          <a class="navbar-brand" href="#">
            <img src="/img/logo.png" alt="Bootstrap" height="50">
          </a>
        </div>
      </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="form-origin mt-5">
                    <form action="/" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="origin" class="form-label ">Kota Asal</label>
                            <select required name="origin" class="form-select" aria-label="Default select example">
                                <option class="text-center">-- Pilih Kota Asal --</option>
                                @foreach ($cities as $city)
                                  <option value="{{ $city['city_id'] }}" {{ request('origin') == $city['city_id'] ? 'selected' : '' }}>{{ $city['city_name'] }}</option>
                                @endforeach
                              </select>
                          </div>
                        <div class="mb-3">
                            <label for="destination" class="form-label ">Kota Tujuan</label>
                            <select required name="destination" class="form-select" aria-label="Default select example">
                                <option class="text-center">-- Pilih Kota Tujuan --</option>
                                @foreach ($cities as $city)
                                  <option value="{{ $city['city_id'] }}" {{ request('destination') ==  $city['city_id'] ? 'selected' : ''}}>{{ $city['city_name'] }}</option>
                                @endforeach
                              </select>
                          </div>
                        <div class="mb-3">
                            <label for="courier" class="form-label ">Kurir</label>
                            <select name="courier" required class="form-select" aria-label="Default select example">
                                <option  class="text-center">-- Pilih Kurir --</option>
                                <option value="jne" {{ request('courier') == 'jne' ? "selected" : '' }}>JNE</option>
                                <option value="pos" {{ request('courier') == 'pos' ? "selected" : '' }}>POS</option>
                                <option value="tiki" {{ request('courier') == 'tiki' ? "selected" : '' }}>TIKI</option>
                              </select>
                          </div>
                        <div class="mb-3">
                            <label for="weight" class="form-label ">Berat (Kg)</label>
                            <input value="{{ request('weight') }}" required placeholder="1" type="number" class="form-control" id="weight" name="weight">
                          </div>
                          <button type="submit" class="btn btn-primary w-100">Cek Harga</button>
                    </form>
                </div>
            </div>
            
            <div class="col-md-7 mx-5">
              @if (!empty($ongkir))
                @foreach ($ongkir as $item)
                  <p class="mt-5">Nama Kurir: <b>{{ $item['name'] }}</b></p>
                @endforeach
              
              
              <table class="table table-hover table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Layanan</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Estimasi</th>
                  </tr>
                </thead>
                <tbody>
                  
                    @foreach ($ongkir as $item)
                      @foreach ($item['costs'] as $cost)
                      <tr>
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ $cost['description'] }}</td>

                        @foreach ($cost['cost'] as $harga)
                            <td>{{ $harga['value'] }}</td>

                            <td>{{ $harga['etd'] }} Hari</td>
                          </tr>
                        @endforeach
                      @endforeach
                    @endforeach
                  
                </tbody>
              </table>

              @endif
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>