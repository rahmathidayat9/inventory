<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\I18n\Time;
use \Hermawan\DataTables\DataTable;
use Ramsey\Uuid\Uuid;

class Dashboard extends BaseController
{
    public function index()
    {
        if ($this->request->isAJAX()) {
            /* Dashboard Summary Data */
            $total_rak = $this->db->table('rak')->countAllResults();
            $total_supplier = $this->db->table('supplier')->countAllResults();
            $total_jenis_barang = $this->db->table('jenis_barang')->countAllResults();
            $total_barang = $this->db->table('barang')->countAllResults();
            $total_customer = $this->db->table('customer')->countAllResults();
            $total_barang_masuk = $this->db->table('barang_masuk')->countAllResults();
            $total_barang_keluar = $this->db->table('barang_keluar')->countAllResults();
            
            $total_admin = $this->db->table('users')
                ->where('roles.role', 'admin')
                ->join('roles', 'roles.id=users.role_id')
                ->countAllResults();

            $total_petugas = $this->db->table('users')
                ->where('roles.role', 'petugas')
                ->join('roles', 'roles.id=users.role_id')
                ->countAllResults();

            /* Chart Data */
            $tahun = date('Y');

            if ($this->request->getVar('tahun')) {
                $tahun = $this->request->getVar('tahun');
            }
            
            $overview_rak = $this->db->query("SELECT rak.rak_name , COUNT(barang.id) AS total_barang, COALESCE(SUM(barang.barang_stock), 0) AS qty FROM rak LEFT JOIN barang ON rak.id = barang.rak_id GROUP BY rak.rak_name ORDER BY rak.rak_name ASC")->getResultArray();
            $top_five_supplier = $this->db->query("SELECT supplier.supplier_name, COUNT(barang.id) AS total_barang FROM supplier JOIN barang ON supplier.id = barang.supplier_id GROUP BY supplier.supplier_name ORDER BY total_barang DESC LIMIT 5")->getResultArray();
            $jenis_barang_chart = $this->db->query("SELECT jenis_barang.jenis AS jenis_barang,COUNT(barang.id) AS total_barang, SUM(barang.barang_stock) AS stock_barang FROM jenis_barang JOIN barang ON jenis_barang.id=barang.jenis_barang_id GROUP BY jenis_barang.jenis")->getResultArray();
            $barang_masuk_chart = $this->db->query("SELECT bulan_statis.bulan,COUNT(barang_masuk.id) AS jumlah_masuk FROM bulan_statis LEFT JOIN barang_masuk ON bulan_statis.no=barang_masuk.no_bulan AND YEAR(barang_masuk.tanggal) = '".$tahun."' GROUP BY bulan_statis.bulan ORDER BY bulan_statis.no ASC")->getResultArray();
            $barang_keluar_chart = $this->db->query("SELECT bulan_statis.bulan,COUNT(barang_keluar.id) AS jumlah_keluar FROM bulan_statis LEFT JOIN barang_keluar ON bulan_statis.no=barang_keluar.no_bulan AND YEAR(barang_keluar.tanggal) = '".$tahun."' GROUP BY bulan_statis.bulan ORDER BY bulan_statis.no ASC")->getResultArray();

            return $this->response->setJSON([
                'total_rak' => $total_rak,
                'total_supplier' => $total_supplier,
                'total_jenis_barang' => $total_jenis_barang,
                'total_barang' => $total_barang,
                'total_customer' => $total_customer,
                'total_barang_masuk' => $total_barang_masuk,
                'total_barang_keluar' => $total_barang_keluar,
                'total_admin' => $total_admin,
                'total_petugas' => $total_petugas,
                'overview_rak' => $overview_rak,
                'top_five_supplier' => $top_five_supplier,
                'jenis_barang_chart' => $jenis_barang_chart,
                'barang_masuk_chart' => $barang_masuk_chart,
                'barang_keluar_chart' => $barang_keluar_chart,
            ]);
        }

        return view('dashboard/index', [
            'title' => 'Dashboard',
        ]);
    }

    /* Manajemen Users */
    public function listUser($role)
    {
        $builder = $this->db->table('users')
            ->where('roles.role', $role)
            ->join('roles', 'roles.id=users.role_id')
            ->select('users.id, users.name, users.username, users.phone');

        return DataTable::of($builder)
            ->add('checkbox', function($value){
                return '<th>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="checkbox[]" class="custom-control-input checkbox" value="'.$value->id.'" id="'.$value->id.'">
                    <label class="custom-control-label" for="'.$value->id.'"></label>
                </div>
            </th>';
            }, 'first')
            ->add('action', function($value){
                return '<button type="button" class="btn btn-primary btn-sm" data-id="'.$value->id.'" id="editBtn" ><i class="fas fa-edit"></i></button> 
                <button type="button" class="btn btn-danger btn-sm" data-id="'.$value->id.'" id="deleteBtn" ><i class="fas fa-trash"></i></button>';
            }, 'last')
            ->hide('id')
            ->toJson();
    }

    public function listAdmin()
    {
        if ($this->request->isAJAX()) {
            return $this->listUser('admin');
        }

        return view('dashboard/list-admin', [
            'title' => 'Manajemen Admin',
        ]);
    }

    public function listPetugas()
    {
        if ($this->request->isAJAX()) {
            return $this->listUser('petugas');   
        }

        return view('dashboard/list-petugas', [
            'title' => 'Manajemen Petugas',
        ]);
    }

    public function insertUser()
    {
        $this->db->table('users')
            ->insert([
                'id' => Uuid::uuid4(),
                'username' => $this->request->getVar('username'),
                'name' => $this->request->getVar('name'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
                'phone' => $this->request->getVar('phone'),
                'role_id' => $this->request->getVar('role_id'),                
            ]);
        
        return $this->response->setJSON([
            'message' => 'Data berhasil disimpan!',
        ]);
    }

    public function editUser()
    {
        $id = $this->request->getVar('id');

        $user = $this->db->table('users')
            ->where('id', $id)
            ->get()
            ->getRowArray();
        
        return $this->response->setJSON([
            'data' => $user,
        ]);
    }

    public function updateUser()
    {
        $id = $this->request->getVar('user_id');
        $now_password = $this->request->getVar('now_password');
        $new_password = $this->request->getVar('new_password');
        $password = "";

        if ($new_password != null) {
            $password = password_hash($new_password, PASSWORD_BCRYPT);
        } else {
            $password = $now_password;
        }

        $this->db->table('users')
            ->where('id', $id)
            ->update([
                'username' => $this->request->getVar('username'),
                'name' => $this->request->getVar('name'),
                'password' => $password,
                'phone' => $this->request->getVar('phone'),                
            ]);
        
        return $this->response->setJSON([
            'message' => 'Data berhasil disimpan!',
        ]);
    }

    public function deleteUser()
    {
        $id = $this->request->getVar('id');

        $this->db->table('users')
            ->where('id', $id)
            ->delete();
        
        return $this->response->setJSON([
            'message' => 'Data berhasil dihapus!',
        ]);
    }

    public function deleteBulkUser()
    {
        $id = $this->request->getVar('id');

        $this->db->query("DELETE FROM users WHERE id IN ($id)");
        
        return $this->response->setJSON([
            'message' => 'Data berhasil dihapus!',
        ]);
    }

    /* Manajemen Supplier */
    public function listSupplier()
    {
        if ($this->request->isAJAX()) {
            $builder = $this->db->table('supplier')
                ->select('id, supplier_name, supplier_email, supplier_phone');

            return DataTable::of($builder)
                ->add('checkbox', function($value){
                    return '<th>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="checkbox[]" class="custom-control-input checkbox" value="'.$value->id.'" id="'.$value->id.'">
                        <label class="custom-control-label" for="'.$value->id.'"></label>
                    </div>
                </th>';
                }, 'first')
                ->add('action', function($value){
                    return '<button type="button" class="btn btn-primary btn-sm" data-id="'.$value->id.'" id="editBtn" ><i class="fas fa-edit"></i></button> 
                    <button type="button" class="btn btn-danger btn-sm" data-id="'.$value->id.'" id="deleteBtn" ><i class="fas fa-trash"></i></button>';
                }, 'last')
                ->hide('id')
                ->toJson();
        }

        return view('dashboard/supplier', [
            'title' => 'Supplier',
        ]);
    }

    public function insertSupplier()
    {
        $this->db->table('supplier')
            ->insert([
                'id' => Uuid::uuid4(),
                'supplier_name' => $this->request->getVar('supplier_name'),
                'supplier_email' => $this->request->getVar('supplier_email'),
                'supplier_address' => $this->request->getVar('supplier_address'),
                'supplier_phone' => $this->request->getVar('supplier_phone'),                
            ]);
        
        return $this->response->setJSON([
            'message' => 'Data berhasil disimpan!',
        ]);
    }

    public function editSupplier()
    {
        $id = $this->request->getVar('id');

        $supplier = $this->db->table('supplier')
            ->where('id', $id)
            ->get()
            ->getRowArray();
        
        return $this->response->setJSON([
            'data' => $supplier,
        ]);
    }

    public function updateSupplier()
    {
        $id = $this->request->getVar('supplier_id');

        $this->db->table('supplier')
            ->where('id', $id)
            ->update([
                'supplier_name' => $this->request->getVar('supplier_name'),
                'supplier_email' => $this->request->getVar('supplier_email'),
                'supplier_phone' => $this->request->getVar('supplier_phone'),
                'supplier_address' => $this->request->getVar('supplier_address'),                
            ]);
        
        return $this->response->setJSON([
            'message' => 'Data berhasil disimpan!',
        ]);
    }

    public function deleteSupplier()
    {
        $id = $this->request->getVar('id');

        $this->db->table('supplier')
            ->where('id', $id)
            ->delete();
        
        return $this->response->setJSON([
            'message' => 'Data berhasil dihapus!',
        ]);
    }

    public function deleteBulkSupplier()
    {
        $id = $this->request->getVar('id');

        $this->db->query("DELETE FROM supplier WHERE id IN ($id)");
        
        return $this->response->setJSON([
            'message' => 'Data berhasil dihapus!',
        ]);
    }

    /* Manajemen Customer */
    public function listCustomer()
    {
        if ($this->request->isAJAX()) {
            $builder = $this->db->table('customer')
                ->select('id, customer_name, customer_email, customer_phone');

            return DataTable::of($builder)
                ->add('checkbox', function($value){
                    return '<th>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="checkbox[]" class="custom-control-input checkbox" value="'.$value->id.'" id="'.$value->id.'">
                        <label class="custom-control-label" for="'.$value->id.'"></label>
                    </div>
                </th>';
                }, 'first')
                ->add('action', function($value){
                    return '<button type="button" class="btn btn-primary btn-sm" data-id="'.$value->id.'" id="editBtn" ><i class="fas fa-edit"></i></button> 
                    <button type="button" class="btn btn-danger btn-sm" data-id="'.$value->id.'" id="deleteBtn" ><i class="fas fa-trash"></i></button>';
                }, 'last')
                ->hide('id')
                ->toJson();
        }

        return view('dashboard/customer', [
            'title' => 'Customer',
        ]);
    }

    public function insertCustomer()
    {
        $this->db->table('customer')
            ->insert([
                'id' => Uuid::uuid4(),
                'customer_name' => $this->request->getVar('customer_name'),
                'customer_email' => $this->request->getVar('customer_email'),
                'customer_address' => $this->request->getVar('customer_address'),
                'customer_phone' => $this->request->getVar('customer_phone'),                
            ]);
        
        return $this->response->setJSON([
            'message' => 'Data berhasil disimpan!',
        ]);
    }

    public function editCustomer()
    {
        $id = $this->request->getVar('id');

        $customer = $this->db->table('customer')
            ->where('id', $id)
            ->get()
            ->getRowArray();
        
        return $this->response->setJSON([
            'data' => $customer,
        ]);
    }

    public function updateCustomer()
    {
        $id = $this->request->getVar('customer_id');

        $this->db->table('customer')
            ->where('id', $id)
            ->update([
                'customer_name' => $this->request->getVar('customer_name'),
                'customer_email' => $this->request->getVar('customer_email'),
                'customer_phone' => $this->request->getVar('customer_phone'),
                'customer_address' => $this->request->getVar('customer_address'),                
            ]);
        
        return $this->response->setJSON([
            'message' => 'Data berhasil disimpan!',
        ]);
    }

    public function deleteCustomer()
    {
        $id = $this->request->getVar('id');

        $this->db->table('customer')
            ->where('id', $id)
            ->delete();
        
        return $this->response->setJSON([
            'message' => 'Data berhasil dihapus!',
        ]);
    }

    public function deleteBulkCustomer()
    {
        $id = $this->request->getVar('id');

        $this->db->query("DELETE FROM customer WHERE id IN ($id)");
        
        return $this->response->setJSON([
            'message' => 'Data berhasil dihapus!',
        ]);
    }

    /* Manajemen Rak */
    public function listRak()
    {
        if ($this->request->isAJAX()) {
            $builder = $this->db->table('rak')
                ->orderBy('rak_name', 'ASC')
                ->select('id, rak_name');

            return DataTable::of($builder)
                ->add('checkbox', function($value){
                    return '<th>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="checkbox[]" class="custom-control-input checkbox" value="'.$value->id.'" id="'.$value->id.'">
                        <label class="custom-control-label" for="'.$value->id.'"></label>
                    </div>
                </th>';
                }, 'first')
                ->add('action', function($value){
                    return '<button type="button" class="btn btn-primary btn-sm" data-id="'.$value->id.'" id="editBtn" ><i class="fas fa-edit"></i></button> 
                    <button type="button" class="btn btn-danger btn-sm" data-id="'.$value->id.'" id="deleteBtn" ><i class="fas fa-trash"></i></button>';
                }, 'last')
                ->hide('id')
                ->toJson();
        }

        return view('dashboard/rak', [
            'title' => 'Rak',
        ]);
    }

    public function insertRak()
    {
        $this->db->table('rak')
            ->insert([
                'id' => Uuid::uuid4(),
                'rak_name' => $this->request->getVar('rak_name'),
            ]);
        
        return $this->response->setJSON([
            'message' => 'Data berhasil disimpan!',
        ]);
    }

    public function editRak()
    {
        $id = $this->request->getVar('id');

        $rak = $this->db->table('rak')
            ->where('id', $id)
            ->get()
            ->getRowArray();
        
        return $this->response->setJSON([
            'data' => $rak,
        ]);
    }

    public function updateRak()
    {
        $id = $this->request->getVar('rak_id');

        $this->db->table('rak')
            ->where('id', $id)
            ->update([
                'rak_name' => $this->request->getVar('rak_name'),            
            ]);
        
        return $this->response->setJSON([
            'message' => 'Data berhasil disimpan!',
        ]);
    }

    public function deleteRak()
    {
        $id = $this->request->getVar('id');

        $this->db->table('rak')
            ->where('id', $id)
            ->delete();
        
        return $this->response->setJSON([
            'message' => 'Data berhasil dihapus!',
        ]);
    }

    public function deleteBulkRak()
    {
        $id = $this->request->getVar('id');

        $this->db->query("DELETE FROM rak WHERE id IN ($id)");
        
        return $this->response->setJSON([
            'message' => 'Data berhasil dihapus!',
        ]);
    }

    /* Manajemen Satuan Barang */
    public function listSatuanBarang()
    {
        if ($this->request->isAJAX()) {
            $builder = $this->db->table('satuan_barang')
                ->select('id, satuan');

            return DataTable::of($builder)
                ->add('checkbox', function($value){
                    return '<th>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="checkbox[]" class="custom-control-input checkbox" value="'.$value->id.'" id="'.$value->id.'">
                        <label class="custom-control-label" for="'.$value->id.'"></label>
                    </div>
                </th>';
                }, 'first')
                ->add('action', function($value){
                    return '<button type="button" class="btn btn-primary btn-sm" data-id="'.$value->id.'" id="editBtn" ><i class="fas fa-edit"></i></button> 
                    <button type="button" class="btn btn-danger btn-sm" data-id="'.$value->id.'" id="deleteBtn" ><i class="fas fa-trash"></i></button>';
                }, 'last')
                ->hide('id')
                ->toJson();
        }

        return view('dashboard/satuan-barang', [
            'title' => 'Satuan Barang',
        ]);
    }

    public function insertSatuanBarang()
    {
        $this->db->table('satuan_barang')
            ->insert([
                'id' => Uuid::uuid4(),
                'satuan' => $this->request->getVar('satuan'),
            ]);
        
        return $this->response->setJSON([
            'message' => 'Data berhasil disimpan!',
        ]);
    }

    public function editSatuanBarang()
    {
        $id = $this->request->getVar('id');

        $satuan_barang = $this->db->table('satuan_barang')
            ->where('id', $id)
            ->get()
            ->getRowArray();
        
        return $this->response->setJSON([
            'data' => $satuan_barang,
        ]);
    }

    public function updateSatuanBarang()
    {
        $id = $this->request->getVar('satuan_barang_id');

        $this->db->table('satuan_barang')
            ->where('id', $id)
            ->update([
                'satuan' => $this->request->getVar('satuan'),
            ]);
        
        return $this->response->setJSON([
            'message' => 'Data berhasil disimpan!',
        ]);
    }

    public function deleteSatuanBarang()
    {
        $id = $this->request->getVar('id');

        $this->db->table('satuan_barang')
            ->where('id', $id)
            ->delete();
        
        return $this->response->setJSON([
            'message' => 'Data berhasil dihapus!',
        ]);
    }

    public function deleteBulkSatuanBarang()
    {
        $id = $this->request->getVar('id');

        $this->db->query("DELETE FROM satuan_barang WHERE id IN ($id)");
        
        return $this->response->setJSON([
            'message' => 'Data berhasil dihapus!',
        ]);
    }

    /* Manajemen Jenis Barang */
    public function listJenisBarang()
    {
        if ($this->request->isAJAX()) {
            $builder = $this->db->table('jenis_barang')
                ->select('id, jenis');

            return DataTable::of($builder)
                ->add('checkbox', function($value){
                    return '<th>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="checkbox[]" class="custom-control-input checkbox" value="'.$value->id.'" id="'.$value->id.'">
                        <label class="custom-control-label" for="'.$value->id.'"></label>
                    </div>
                </th>';
                }, 'first')
                ->add('action', function($value){
                    return '<button type="button" class="btn btn-primary btn-sm" data-id="'.$value->id.'" id="editBtn" ><i class="fas fa-edit"></i></button> 
                    <button type="button" class="btn btn-danger btn-sm" data-id="'.$value->id.'" id="deleteBtn" ><i class="fas fa-trash"></i></button>';
                }, 'last')
                ->hide('id')
                ->toJson();
        }

        return view('dashboard/jenis-barang', [
            'title' => 'Jenis Barang',
        ]);
    }

    public function insertJenisBarang()
    {
        $this->db->table('jenis_barang')
            ->insert([
                'id' => Uuid::uuid4(),
                'jenis' => $this->request->getVar('jenis'),
            ]);
        
        return $this->response->setJSON([
            'message' => 'Data berhasil disimpan!',
        ]);
    }

    public function editJenisBarang()
    {
        $id = $this->request->getVar('id');

        $jenis_barang = $this->db->table('jenis_barang')
            ->where('id', $id)
            ->get()
            ->getRowArray();
        
        return $this->response->setJSON([
            'data' => $jenis_barang,
        ]);
    }

    public function updateJenisBarang()
    {
        $id = $this->request->getVar('jenis_barang_id');

        $this->db->table('jenis_barang')
            ->where('id', $id)
            ->update([
                'jenis' => $this->request->getVar('jenis'),
            ]);
        
        return $this->response->setJSON([
            'message' => 'Data berhasil disimpan!',
        ]);
    }

    public function deleteJenisBarang()
    {
        $id = $this->request->getVar('id');

        $this->db->table('jenis_barang')
            ->where('id', $id)
            ->delete();
        
        return $this->response->setJSON([
            'message' => 'Data berhasil dihapus!',
        ]);
    }

    public function deleteBulkJenisBarang()
    {
        $id = $this->request->getVar('id');

        $this->db->query("DELETE FROM jenis_barang WHERE id IN ($id)");
        
        return $this->response->setJSON([
            'message' => 'Data berhasil dihapus!',
        ]);
    }

    /* Manajemen Barang */
    public function listBarang()
    {
        if ($this->request->isAJAX()) {
            $builder = $this->db->table('barang')
                ->select('barang.id, barang.barang_name, barang.barang_code, 
                CONCAT(barang.barang_stock, " ", satuan_barang.satuan) AS stock, rak.rak_name, supplier.supplier_name')
                ->join('satuan_barang', 'satuan_barang.id = barang.satuan_barang_id')
                ->join('rak', 'rak.id = barang.rak_id')
                ->join('supplier', 'supplier.id = barang.supplier_id')
                ->orderBy('barang.tanggal', 'DESC');

            return DataTable::of($builder)
                ->add('checkbox', function($value){
                    return '<th>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="checkbox[]" class="custom-control-input checkbox" value="'.$value->id.'" id="'.$value->id.'">
                        <label class="custom-control-label" for="'.$value->id.'"></label>
                    </div>
                </th>';
                }, 'first')
                ->add('action', function($value){
                    return '<button type="button" class="btn btn-primary btn-sm" data-id="'.$value->id.'" id="editBtn" ><i class="fas fa-edit"></i></button> 
                    <button type="button" class="btn btn-danger btn-sm" data-id="'.$value->id.'" id="deleteBtn" ><i class="fas fa-trash"></i></button>';
                }, 'last')
                ->hide('id')
                ->toJson();
        }

        $jenis_barang = $this->db->table('jenis_barang')
            ->get()
            ->getResultArray();
            
        $supplier = $this->db->table('supplier')
            ->get()
            ->getResultArray();

        $satuan_barang = $this->db->table('satuan_barang')
            ->get()
            ->getResultArray();

        $rak = $this->db->table('rak')
            ->orderBy('rak_name', 'ASC')
            ->get()
            ->getResultArray();

        return view('dashboard/barang', [
            'title' => 'Stok Barang',
            'jenis_barang' => $jenis_barang,
            'supplier' => $supplier,
            'satuan_barang' => $satuan_barang,
            'rak' => $rak,
        ]);
    }

    public function insertBarang()
    {
        $tanggal = Time::now('Asia/Jakarta')->toDateTimeString();

        $this->db->table('barang')
            ->insert([
                'id' => Uuid::uuid4(),
                'barang_code' => 'BRG'.random_int(70000, 90000),
                'barang_name' => $this->request->getVar('barang_name'),
                'barang_stock' => $this->request->getVar('barang_stock'),
                'satuan_barang_id' => $this->request->getVar('satuan_barang_id'),
                'rak_id' => $this->request->getVar('rak_id'),
                'jenis_barang_id' => $this->request->getVar('jenis_barang_id'),
                'supplier_id' => $this->request->getVar('supplier_id'),
                'tanggal' => $tanggal,
            ]);
        
        return $this->response->setJSON([
            'message' => 'Data berhasil disimpan!',
        ]);
    }

    public function editBarang()
    {
        $id = $this->request->getVar('id');

        $barang = $this->db->table('barang')
            ->where('id', $id)
            ->get()
            ->getRowArray();
        
        return $this->response->setJSON([
            'data' => $barang,
        ]);
    }

    public function updateBarang()
    {
        $id = $this->request->getVar('barang_id');

        $this->db->table('barang')
            ->where('id', $id)
            ->update([
                'barang_name' => $this->request->getVar('barang_name'),
                'barang_stock' => $this->request->getVar('barang_stock'),
                'satuan_barang_id' => $this->request->getVar('satuan_barang_id'),
                'rak_id' => $this->request->getVar('rak_id'),
                'jenis_barang_id' => $this->request->getVar('jenis_barang_id'),
                'supplier_id' => $this->request->getVar('supplier_id'),
            ]);
        
        return $this->response->setJSON([
            'message' => 'Data berhasil disimpan!',
        ]);
    }

    public function deleteBarang()
    {
        $id = $this->request->getVar('id');

        $this->db->table('barang')
            ->where('id', $id)
            ->delete();
        
        return $this->response->setJSON([
            'message' => 'Data berhasil dihapus!',
        ]);
    }

    public function deleteBulkBarang()
    {
        $id = $this->request->getVar('id');

        $this->db->query("DELETE FROM barang WHERE id IN ($id)");
        
        return $this->response->setJSON([
            'message' => 'Data berhasil dihapus!',
        ]);
    }

    /* Manajemen Barang Masuk */
    public function listBarangMasuk()
    {
        if ($this->request->isAJAX()) {
            $builder = $this->db->table('barang_masuk')
                ->select('barang_masuk.id,barang.barang_name,supplier.supplier_name,CONCAT(barang_masuk.qty, " ", satuan_barang.satuan) AS qty,DATE(barang_masuk.tanggal) AS tanggal,users.name AS petugas')
                ->join('supplier', 'supplier.id = barang_masuk.supplier_id')
                ->join('barang', 'barang.id = barang_masuk.barang_id')
                ->join('satuan_barang', 'satuan_barang.id = barang.satuan_barang_id')
                ->join('users', 'users.id = barang_masuk.user_id')
                ->orderBy('barang_masuk.tanggal', 'DESC');

            return DataTable::of($builder)
                ->add('checkbox', function($value){
                    return '<th>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="checkbox[]" class="custom-control-input checkbox" value="'.$value->id.'" id="'.$value->id.'">
                        <label class="custom-control-label" for="'.$value->id.'"></label>
                    </div>
                </th>';
                }, 'first')
                ->add('action', function($value){
                    return '<button type="button" class="btn btn-success btn-sm" data-id="'.$value->id.'" id="detailBtn" ><i class="fas fa-info fa-fw"></i></button> 
                    <button type="button" class="btn btn-danger btn-sm" data-id="'.$value->id.'" id="deleteBtn" ><i class="fas fa-trash fa-fw"></i></button>';
                }, 'last')
                ->hide('id')
                ->toJson();
        }

        $supplier = $this->db->table('supplier')
            ->get()
            ->getResultArray();

        return view('dashboard/barang-masuk', [
            'title' => 'Barang Masuk',
            'supplier' => $supplier,
        ]);
    }

    public function barangSupplierFilter()
    {
        $supplier_id = $this->request->getVar('supplier_id');

        $data = $this->db->table('barang')
            ->join('satuan_barang', 'satuan_barang.id=barang.satuan_barang_id')
            ->where('supplier_id', $supplier_id)
            ->select('barang.id,barang.barang_name,satuan_barang.satuan,barang.barang_stock')
            ->get()
            ->getResultArray();
        
        return $this->response->setJSON([
            'data' => $data,
        ]);
    }

    public function insertBarangMasuk()
    {
        $barang_id = $this->request->getVar('barang_id');
        $qty = $this->request->getVar('qty');
        $tanggal = Time::now('Asia/Jakarta')->toDateTimeString();

        $stok_barang = $this->db->table('barang')
            ->where('id', $barang_id)
            ->select('barang_stock')
            ->get()
            ->getRowArray();

        $this->db->table('barang_masuk')
            ->insert([
                'id' => Uuid::uuid4(),
                'barang_id' => $barang_id,
                'supplier_id' => $this->request->getVar('supplier_id'),
                'qty' => $qty,
                'user_id' => user('id'),
                'tanggal' => $tanggal,
                'no_bulan' => date('n'),
            ]);
        
        $stock = $stok_barang['barang_stock'] + $qty;
        
        $this->db->table('barang')
            ->where('id', $barang_id)
            ->update([
                'barang_stock' => $stock,
            ]);
        
        return $this->response->setJSON([
            'message' => 'Data berhasil disimpan!',
        ]);
    }

    public function detailBarangMasuk()
    {
        $id = $this->request->getVar('id');

        $barang_masuk = $this->db->table('barang_masuk')
            ->where('barang_masuk.id', $id)
            ->select('barang_masuk.id,barang_masuk.supplier_id,barang_masuk.barang_id,barang_masuk.qty,barang_masuk.tanggal,barang.barang_stock')
            ->join('barang', 'barang.id=barang_masuk.barang_id')
            ->get()
            ->getRowArray();
        
        return $this->response->setJSON([
            'data' => $barang_masuk,
        ]);
    }

    public function deleteBarangMasuk()
    {
        $id = $this->request->getVar('id');

        $this->db->table('barang_masuk')
            ->where('id', $id)
            ->delete();
        
        return $this->response->setJSON([
            'message' => 'Data berhasil dihapus!',
        ]);
    }

    public function deleteBulkBarangMasuk()
    {
        $id = $this->request->getVar('id');

        $this->db->query("DELETE FROM barang_masuk WHERE id IN ($id)");
        
        return $this->response->setJSON([
            'message' => 'Data berhasil dihapus!',
        ]);
    }

    /* Manajemen Barang Masuk */
    public function listBarangKeluar()
    {
        if ($this->request->isAJAX()) {
            $builder = $this->db->table('barang_keluar')
                ->select('barang_keluar.id,barang.barang_name,CONCAT(barang_keluar.qty, " ", satuan_barang.satuan) AS qty,barang_keluar.tanggal,users.name AS petugas')
                ->join('barang', 'barang.id = barang_keluar.barang_id')
                ->join('satuan_barang', 'satuan_barang.id = barang.satuan_barang_id')
                ->join('users', 'users.id = barang_keluar.user_id')
                ->orderBy('barang_keluar.tanggal', 'DESC');

            return DataTable::of($builder)
                ->add('checkbox', function($value){
                    return '<th>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="checkbox[]" class="custom-control-input checkbox" value="'.$value->id.'" id="'.$value->id.'">
                        <label class="custom-control-label" for="'.$value->id.'"></label>
                    </div>
                </th>';
                }, 'first')
                ->add('action', function($value){
                    return '<button type="button" class="btn btn-success btn-sm" data-id="'.$value->id.'" id="detailBtn" ><i class="fas fa-info fa-fw"></i></button> 
                    <button type="button" class="btn btn-danger btn-sm" data-id="'.$value->id.'" id="deleteBtn" ><i class="fas fa-trash fa-fw"></i></button>';
                }, 'last')
                ->hide('id')
                ->toJson();
        }

        $rak = $this->db->table('rak')
            ->orderBy('rak_name', 'ASC')
            ->get()
            ->getResultArray();

        $customer = $this->db->table('customer')
            ->orderBy('customer_name', 'ASC')
            ->get()
            ->getResultArray();

        return view('dashboard/barang-keluar', [
            'title' => 'Barang Keluar',
            'rak' => $rak,
            'customer' => $customer,
        ]);
    }

    public function barangRakFilter()
    {
        $rak_id = $this->request->getVar('rak_id');

        $data = $this->db->table('barang')
            ->join('satuan_barang', 'satuan_barang.id=barang.satuan_barang_id')
            ->where('rak_id', $rak_id)
            ->select('barang.id,barang.barang_name,satuan_barang.satuan,barang.barang_stock')
            ->get()
            ->getResultArray();
        
        return $this->response->setJSON([
            'data' => $data,
        ]);
    }

    public function insertBarangKeluar()
    {
        $barang_id = $this->request->getVar('barang_id');
        $qty = $this->request->getVar('qty');
        $tanggal = Time::now('Asia/Jakarta')->toDateTimeString();

        $stok_barang = $this->db->table('barang')
            ->where('id', $barang_id)
            ->select('barang_stock')
            ->get()
            ->getRowArray();

        $this->db->table('barang_keluar')
            ->insert([
                'id' => Uuid::uuid4(),
                'barang_id' => $barang_id,
                'customer_id' => $this->request->getVar('customer_id'),
                'qty' => $qty,
                'user_id' => user('id'),
                'keterangan' => $this->request->getVar('keterangan'),
                'tanggal' => $tanggal,
                'no_bulan' => date('n'),
            ]);
        
        $stock = $stok_barang['barang_stock'] - $qty;
        
        $this->db->table('barang')
            ->where('id', $barang_id)
            ->update([
                'barang_stock' => $stock,
            ]);
        
        return $this->response->setJSON([
            'message' => 'Data berhasil disimpan!',
        ]);
    }

    public function detailBarangKeluar()
    {
        $id = $this->request->getVar('id');

        $barang_keluar = $this->db->table('barang_keluar')
            ->where('barang_keluar.id', $id)
            ->select('barang_keluar.id,barang_keluar.barang_id,barang_keluar.keterangan,barang_keluar.qty,barang_keluar.customer_id,barang_keluar.tanggal,barang.barang_stock,barang.rak_id')
            ->join('barang', 'barang.id=barang_keluar.barang_id')
            ->get()
            ->getRowArray();
        
        return $this->response->setJSON([
            'data' => $barang_keluar,
        ]);
    }

    public function deleteBarangKeluar()
    {
        $id = $this->request->getVar('id');

        $this->db->table('barang_keluar')
            ->where('id', $id)
            ->delete();
        
        return $this->response->setJSON([
            'message' => 'Data berhasil dihapus!',
        ]);
    }

    public function deleteBulkBarangKeluar()
    {
        $id = $this->request->getVar('id');

        $this->db->query("DELETE FROM barang_keluar WHERE id IN ($id)");
        
        return $this->response->setJSON([
            'message' => 'Data berhasil dihapus!',
        ]);
    }

    /* Manajemen Laporan */
    public function laporan()
    {
        return view('dashboard/laporan', [
            'title' => 'Manajemen Laporan',
        ]);
    }

    /* Ekspor Pdf Query */
    public function queryBarangMasuk($tgl_awal, $tgl_akhir)
    {
        $query = $this->db->query("SELECT barang.barang_name, supplier.supplier_name, CONCAT(barang_masuk.qty, ' ', satuan_barang.satuan) AS qty, DATE(barang_masuk.tanggal) AS tanggal, users.name AS petugas FROM barang_masuk JOIN supplier ON supplier.id = barang_masuk.supplier_id JOIN barang ON barang.id = barang_masuk.barang_id JOIN satuan_barang ON satuan_barang.id = barang.satuan_barang_id JOIN users ON users.id = barang_masuk.user_id WHERE DATE(barang_masuk.tanggal) BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."' ORDER BY barang_masuk.tanggal DESC")->getResultArray();

        return $query;
    }

    public function queryBarangKeluar($tgl_awal, $tgl_akhir)
    {
        $query = $this->db->query("SELECT barang.barang_name, CONCAT(barang_keluar.qty, ' ', satuan_barang.satuan) AS qty ,DATE(barang_keluar.tanggal) AS tanggal,users.name AS petugas FROM barang_keluar JOIN barang ON barang.id = barang_keluar.barang_id JOIN satuan_barang ON satuan_barang.id = barang.satuan_barang_id JOIN users ON users.id = barang_keluar.user_id WHERE DATE(barang_keluar.tanggal) BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."' ORDER BY barang_keluar.tanggal DESC")->getResultArray();

        return $query;
    }

    public function queryStokBarang()
    {
        $query = $this->db->query("SELECT barang.id, barang.barang_name, barang.barang_code, CONCAT(barang.barang_stock, ' ',satuan_barang.satuan) AS stock, rak.rak_name, supplier.supplier_name FROM barang JOIN satuan_barang ON satuan_barang.id = barang.satuan_barang_id JOIN rak ON rak.id = barang.rak_id JOIN supplier ON supplier.id = barang.supplier_id ORDER BY rak.rak_name ASC")->getResultArray();

        return $query;
    }

    public function eksporPdf()
    {
        $tgl_awal = $this->request->getVar('tgl_awal');
        $tgl_akhir = $this->request->getVar('tgl_akhir');
        $data = $this->request->getVar('data');
        $isi = "";

        if ($data == 'barang') {
            $isi = $this->queryStokBarang();
        }

        if ($data == 'barang-masuk') {
            $isi = $this->queryBarangMasuk($tgl_awal, $tgl_akhir);
        }

        if ($data == 'barang-keluar') {
            $isi = $this->queryBarangKeluar($tgl_awal, $tgl_akhir);
        }

        $dompdf = new \Dompdf\Dompdf(); 
        $dompdf->loadHtml(view('dashboard/ekspor-pdf/'.$data, [
            'isi' => $isi,
            'tgl_awal' => $tgl_awal,
            'tgl_akhir' => $tgl_akhir,
        ]));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream($data.'-'.date('Y-m-d-H-i-s').".pdf", array("Attachment" => 0));
    }

    /* Manajemen Setting */
    public function setting()
    {
        if ($this->request->isAJAX()) {
            $builder = $this->db->table('bulan_statis')
                ->orderBy('no', 'ASC')
                ->select('id,bulan');
            
            return DataTable::of($builder)
                ->add('action', function($value){
                    return '<button type="button" class="btn btn-primary btn-sm" data-id="'.$value->id.'" id="editBtn" ><i class="fas fa-edit fa-fw"></i></button>';
                }, 'last')
                ->hide('id')
                ->toJson();
        }

        return view('dashboard/setting', [
            'title' => 'Manajemen Settings',
        ]);
    }

    public function editBulan()
    {
        $id = $this->request->getVar('id');

        $bulan = $this->db->table('bulan_statis')
            ->where('id', $id)
            ->get()
            ->getRowArray();
        
        return $this->response->setJSON([
            'data' => $bulan,
        ]);
    }

    public function updateBulan()
    {
        $id = $this->request->getVar('bulan_id');

        $this->db->table('bulan_statis')
            ->where('id', $id)
            ->update([
                'bulan' => $this->request->getVar('bulan'),
            ]);
        
        return $this->response->setJSON([
            'message' => 'Data bulan berhasil di perbarui!',
        ]);
    }

    public function updateProfil()
    {
        $id = user('id');
        $now_password = $this->request->getVar('now_password');
        $new_password = $this->request->getVar('new_password');
        $password = "";

        if ($new_password != null) {
            $password = password_hash($new_password, PASSWORD_BCRYPT);
        } else {
            $password = $now_password;
        }

        $this->db->table('users')
            ->where('id', $id)
            ->update([
                'username' => $this->request->getVar('username'),
                'name' => $this->request->getVar('name'),
                'password' => $password,
                'phone' => $this->request->getVar('phone'),                
            ]);
        
        return $this->response->setJSON([
            'message' => 'Profil berhasil di perbarui!',
        ]);
    }
}
