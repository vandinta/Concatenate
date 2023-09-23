<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <title>Check Ongkir</title>
</head>

<body>
  <div class="container" style="margin: 70px 100px;">
    <div class="card">
      <div class="card-header">
        <h4>List Jenis Paket Pengiriman</h4>
      </div>
      @foreach ($databiaya->results as $kur)
      <div class="card-body">
        <div class="table">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th width="180px">Dari</th>
                <td>{{ $databiaya->origin_details->city_name }}</td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th width="180px">Ke</th>
                <td>{{ $databiaya->destination_details->city_name }}</td>
              </tr>
              <tr>
                <th width="180px">Berat</th>
                <td>{{ $databiaya->query->weight }} Gram</td>
              </tr>
              <tr>
                <th width="180px">Jasa Ekpedisi</th>
                <td>{{ $kur->name }}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="card-row">
          @foreach ($kur->costs as $pil)
          <div class="card" style="max-width: 1100px; margin-bottom: 15px;">
            <div class="card-body">
              @foreach ($pil->cost as $cos)
              <h5 class="card-title float-right">Rp. {{ $cos->value }}</h5>
              <h5 class="card-title">{{ $pil->service }}</h5>
              <p class="card-text" style="margin-top: -14px;"><small class="text-muted">{{ $pil->description }}</small></p>
              <p class="card-text" style="margin-top: -10px;">Perkiraan Waktu {{ $cos->etd }} <?php if($kur->code != 'pos') { echo 'Hari'; } ?></p>
              @endforeach
            </div>
          </div>
          @endforeach
        </div>
      </div>
      @endforeach
      <div class="card-footer text-muted">
        <a href="{{ url()->previous() }}">
        <button type="button" class="btn btn-outline-secondary ml-4">Kembali</button></a>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>