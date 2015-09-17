<legend><?php echo $title;?></legend>
<table class="table table-striped">
    <thead>
        <tr>
            <th>No.</th>
            <th>Kode Buku</th>
            <th>Judul</th>
            <th>Pengarang</th>
            <th>Klasifikasi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=0; foreach($buku as $row): $no++;?>
        <tr>
            <td><?php echo $no;?></td>
            <td><?php echo $row->kode_buku;?></td>
            <td><?php echo $row->judul;?></td>
            <td><?php echo $row->pengarang;?></td>
            <td><?php echo $row->klasifikasi;?></td>
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