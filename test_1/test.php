<?php
class Program
{
    public function perulangan($jumlahPerulangan)
    {
        $hasil = '';
        $bageConcatHit = 0;
        for ($i = 1; $i <= $jumlahPerulangan; $i++) {
            $output = '';

            if ($i % 3 === 0 && $i % 5 === 0) {
                $output = 'Bage Concat';
            } elseif ($i % 3 === 0) {
                $output = 'Bage';
            } elseif ($i % 5 === 0) {
                $output = 'Concat';
            } else {
                $output = "Ke-" . $i;
            }

            if ($output === 'Bage Concat') {
                $bageConcatHit++;
            }

            if ($bageConcatHit > 2) {
                if ($i % 3 === 0) {
                    $output = 'Bage';
                }
                if ($i % 5 === 0) {
                    $output = 'Concat';
                }
            }

            if ($bageConcatHit > 5) {
                break;
            }

            $hasil .= $output . "<br>";
        }

        return $hasil;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['jumlah_perulangan'])) {
        $jumlahPerulangan = (int)$_POST['jumlah_perulangan'];

        $program = new Program();
        $hasilProgram = $program->perulangan($jumlahPerulangan);

        echo "Hasil Program:<br>";
        echo $hasilProgram;
    }
}
?>
