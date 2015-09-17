<legend><?php echo $title;?></legend>
<?php echo isset($message) ? $message : ''; ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>No.</th>
            <th>Tanggal Pesan</th>
            <th>Judul Buku</th>
            <th>Pengarang</th>
            <th>Gambar Buku</th>
            <th>Pemesan</th>
            <th>NIS</th>
            <th>Kelas</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=0; foreach($pemesan_buku as $row): $no++;?>
        <tr>
            <td><?php echo $no;?></td>
            <td><?php echo $row->tgl_pesan;?></td>
            <td><?php echo $row->judul;?></td>
            <td><?php echo $row->pengarang;?></td>
            <td><img src="<?php echo base_url('assets/img/'.$row->buku_img);?>" height="100px" width="100px"></td>
			<td><?php echo $row->nama; ?></td>
			<td><?php echo $row->nis; ?></td>
			<td><?php echo $row->kelas; ?></td>
			<td><a href="#" class="hapus" kode="<?php echo $row->id;?>"><i class="glyphicon glyphicon-trash"></i></a></td>
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
<script>
    $(function(){
        $(".hapus").click(function(){
            var kode=$(this).attr("kode");
            
            $("#idhapus").val(kode);
            $("#myModal").modal("show");
        });
        
        $("#konfirmasi").click(function(){
            var kode=$("#idhapus").val();
            
            $.ajax({
                url:"<?php echo site_url('buku/hapus_pemesan');?>",
                type:"POST",
                data:"kode="+kode,
                cache:false,
                success:function(html){
                    location.href="<?php echo site_url('laporan/pemesan_buku/sukses');?>";
                }
            });
        });
    });
    
</script>