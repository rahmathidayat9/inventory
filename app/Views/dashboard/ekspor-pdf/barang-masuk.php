<!DOCTYPE html>
<html>
<title>Barang Masuk</title>
<head>
<style>
table {
  width:100%;
}
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
th, td {
  padding: 15px;
  text-align: left;
}
table tr:nth-child(even) {
  background-color: #eee;
}
table tr:nth-child(odd) {
 background-color: #fff;
}
</style>
</head>
<body>

<h2>- Data Barang Masuk</h2>
<h4>Tanggal <?= $tgl_awal ?> - <?= $tgl_akhir ?>.</h4>

<table>
  <tr>
    <th>No</th>
    <th>Barang</th>
    <th>Jenis Barang</th>
    <th>Supplier</th> 
    <th>Qty</th>
    <th>Tanggal</th>
    <th>Petugas</th>
  </tr>
  <?php $nilai_awal = 1; ?>
  <?php foreach($isi as $data) { ?>
    <tr>
      <td><?= $nilai_awal++ ?></td>
      <td><?= $data['barang_name'] ?></td>
      <td><?= $data['jenis_barang'] ?></td>
      <td><?= $data['supplier_name'] ?></td>
      <td><?= $data['qty'] ?></td>
      <td><?= $data['tanggal'] ?></td>
      <td><?= $data['petugas'] ?></td>
    </tr>
  <?php } ?>
</table>

</body>
</html>