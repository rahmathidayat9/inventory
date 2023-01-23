<!DOCTYPE html>
<html>
<title>Stok Barang</title>
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

<h2>- Data Stok Barang</h2>

<table>
  <tr>
    <th>No</th>
    <th>Barang</th>
    <th>Jenis Barang</th>
    <th>Stok</th>
    <th>Kode Barang</th>
    <th>Supplier</th> 
    <th>Rak</th>
  </tr>
  <?php $nilai_awal = 1; ?>
  <?php foreach($isi as $data) { ?>
    <tr>
      <td><?= $nilai_awal++ ?></td>
      <td><?= $data['barang_name'] ?></td>
      <td><?= $data['jenis_barang'] ?></td>
      <td><?= $data['stock'] ?></td>
      <td><?= $data['barang_code'] ?></td>
      <td><?= $data['supplier_name'] ?></td>
      <td><?= $data['rak_name'] ?></td>
    </tr>
  <?php } ?>
</table>

</body>
</html>