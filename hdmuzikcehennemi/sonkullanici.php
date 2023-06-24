<?php

include('connect_db.php');

$sql = "SELECT kullanici_adi, kayit_tarihi FROM kullanici_tablosu ORDER BY kayit_tarihi DESC LIMIT 5";
$result = $conn->query($sql);







if ($result->num_rows > 0) {
    



    while ($row = $result->fetch_assoc()) {

        $veritabaniTarih = $row["kayit_tarihi"];
        $hedefTarih = strtotime($veritabaniTarih);
        $bugun = strtotime(date("Y-m-d"));
        $dun = strtotime(date("Y-m-d", strtotime("-1 day")));
        $gunFarki = floor((time() - $hedefTarih) / (60 * 60 * 24));
        
       
        if ($hedefTarih >= $bugun) {
            $formatliTarih = "Bugün";
        } elseif ($hedefTarih >= $dun) {
            $formatliTarih = "Dün";
        } else {
            $formatliTarih = $gunFarki . " gün önce";
        }
        
       
        $veritabaniTarih = $formatliTarih;
        echo '<li><a href="#">'. $row["kullanici_adi"] .'<strong>'. $formatliTarih.'</strong></a></li>';
    }
} else {
    echo "Kayıt bulunamadı";
}

$conn->close();
?>





