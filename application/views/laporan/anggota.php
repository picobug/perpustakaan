<legend><?php echo $title;?></legend>
<table class="table table-striped">
    <thead>
        <tr>
            <th>No.</th>
            <th>Nis</th>
            <th>Nama</th>
            <th>Tanggal Lahir</th>
            <th>Kelas</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=0; foreach($anggota as $row): $no++;?>
        <tr>
            <td><?php echo $no;?></td>
            <td><?php echo $row->nis;?></td>
            <td><?php echo $row->nama;?></td>
            <td><?php echo $row->ttl;?></td>
            <td><?php echo $row->kelas;?></td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
<hr>
<button class="btn btn-success" onclick="javascript:window.print()">Print</button>
<style>
    @media print {
      .navbar.navbar-default, .container > .row > .col-md-3, button.btn {
        display: none;
      }
    }
</style>