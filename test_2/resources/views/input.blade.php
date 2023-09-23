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
    <div class="judul mb-3">
      <h1>Check Ongkir</h1>
    </div>
    <div class="card">
      <div class="card-body">
        <blockquote class="blockquote mb-0">
          <form action="{{ route('check') }}" method="post">
            @csrf
            <input type="hidden" class="form-control" name="kota_asal" id="kota_asal" value="501">
            <div class="form-group">
              <label for="kota_asal">Kota Asal</label>
              <input type="text" class="form-control" name="kota" id="kota" value="Yogyakarta" disabled>
            </div>
            <div class="form-group">
              <label for="provinsi_tujuan">Provinsi Tujuan</label>
              <select class="form-control" id="provinsi_tujuan" name="provinsi_tujuan" required>
                <option value="">Pilih Provinsi Tujuan</option>
                @foreach ($dataprovinsi as $dp)
                <option value="{{ $dp->province_id }}">{{ $dp->province }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="kota_tujuan">Kota Tujuan</label>
              <select class="form-control" id="kota_tujuan" name="kota_tujuan" required>
                <option value="">Pilih Kota Tujuan</option>
              </select>
            </div>
            <div class="form-group">
              <label for="berat">Berat Barang</label>
              <input type="number" class="form-control" name="berat" id="berat" placeholder="1000gr" required>
            </div>
            <div class="form-group">
              <label for="kurir">Jasa Ekspedisi</label>
              <select class="form-control" id="kurir" name="kurir" required>
                <option value="">Pilih Ekspedisi</option>
                <option value="jne">JNE</option>
                <option value="pos">Pos Indonesia</option>
                <option value="tiki">TIKI</option>
              </select>
            </div>
            <button type="submit" id="submitButton" class="btn btn-primary">Check</button>
          </form>
        </blockquote>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#provinsi_tujuan').on('change', function() {
        var province_id = $(this).val();
        if (province_id) {
          $.ajax({
            url: '/getkota/' + province_id,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
              if (data) {
                $('#kota_tujuan').empty();
                $('#kota_tujuan').append('<option hidden>Pilih Kota Tujuan</option>');
                $.each(data, function(id, name) {
                  $('#kota_tujuan').append('<option value="'+ name.city_id +'">' + name.city_name+ '</option>');
                });
              } else {
                $('#kota_tujuan').empty();
              }
            }
          });
        } else {
          $('#kota_tujuan').empty();
          $('#kota_tujuan').append(new Option('Pilih Kota', ''));
        }
      });
    });
  </script>
</body>

</html>