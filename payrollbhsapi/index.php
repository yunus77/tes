<?PHP
$hostname = "localhost";
$database = "payrollbhs_api";
$username = "root";
$password = "";
$connect = mysqli_connect($hostname, $username, $password, $database);
// script cek koneksi   
if (!$connect) {
    die("Koneksi Tidak Berhasil: " . mysqli_connect_error());
}

global $connect;
if (!empty($_GET["id"])) {
    $id = $_GET["id"]; 
    $exp = explode("-", $id);
    $bulan = $exp[0];
    $tahun = $exp[1];
    $nik = $exp[2];
    
    $where_nik = ($nik=="all") ? "" : " AND nik='$nik' ";

    $query ="SELECT * FROM absensi WHERE YEAR(tgl)='$tahun' AND MONTH(tgl)='$bulan' $where_nik ";        
    $result = $connect->query($query);
    while($row = mysqli_fetch_object($result))
    {
        $data[] = $row;
    }            
    if($data)
    {
    $response = array(
                    'status' => 1,
                    'message' =>'Success',
                    'data' => $data
                );               
    }else {
        $response=array(
                    'status' => 0,
                    'message' =>'No Data Found'
                );
    }
}else{
    $response=array(
        'status' => 0,
        'message' =>'Wrong Parameter'
    );
}

header('Content-Type: application/json');
echo json_encode($response);

?>
