<?php
function bulanIndo($val="") {
  if($val == "") {
    $month = [
      1 => 'Januari',
      2 => 'Februari',
      3 => 'Maret',
      4 => 'April',
      5 => 'Mei',
      6 => 'Juni',
      7 => 'Juli',
      8 => 'Agustus',
      9 => 'September',
      10 => 'Oktober',
      11 => 'November',
      12 => 'Desember'
    ];
    return $month;
  } else {
    $month = [
      0 => '-- Bulan --',
      1 => 'Januari',
      2 => 'Februari',
      3 => 'Maret',
      4 => 'April',
      5 => 'Mei',
      6 => 'Juni',
      7 => 'Juli',
      8 => 'Agustus',
      9 => 'September',
      10 => 'Oktober',
      11 => 'November',
      12 => 'Desember'
    ];
    return $month[$val];
  }
}

function hariIndo() {
  $hari = [
    '-- Hari --' => 0,
    'Senin' => 'senin',
    'Selasa' => 'selasa',
    'Rabu' => 'rabu',
    'Kamis' => 'kamis',
    'Jumat' => 'jumat',
    'Sabtu' => 'sabtu',
    'Minggu' => 'minggu'
  ];

  return $hari;
}

function dateIndo($data) {
  if($data == NULL || $data == "") {
    return "";
  } else {
    $x_data = explode("-", $data);
    $bulan = bulanIndo((int) $x_data[1]);
    $output = $x_data[2]." ".$bulan." ".$x_data[0];
    
    return $output;
  }
}

function timeIndo($data) {
  if($data == NULL || $data == "") {
    return "";
  } else {
    $time = explode(":", $data);
    $output = $time[0].":".$time[1];

    return $output;
  }
}

function datetimeIndo($data) {
	if ($data == "") {
		return "";
	} else {
		$x_data = explode(" ", $data);
		$date = dateIndo($x_data[0]);
		$time = timeIndo($x_data[1]);
		$output = $date." - ".$time;
	
		return $output;
	}
}
?>
