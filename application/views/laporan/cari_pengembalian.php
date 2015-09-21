<table class="table table-striped">
    <thead>
        <tr>
            <th>No.</th>
            <th>ID Transaksi</th>
            <th>Tanggal Pengembalian</th>
            <th>Denda</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=0; foreach($lap as $row): $no++;?>
        <tr>
            <td><?php echo $no;?></td>
            <td><a href="<?php echo site_url('laporan/detail_pinjam/'.$row->id_transaksi);?>"><?php echo $row->id_transaksi;?></a></td>
            <td><?php echo $row->tanggal_kembali;?></td>
            <td><?php echo $row->nominal;?></td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
<button class="btn btn-success" onclick="javascript:window.print()">Print</button>
<style>
    @media print {
      .navbar.navbar-default, .container > .row > .col-md-3, button.btn {
        display: none;
      }
    }
</style>