<table class="table table-striped">
    <thead>
        <tr>
            <td>Kode Buku</td>
            <td>Judul Buku</td>
            <td>Pengarang</td>
            <td>Aksi</td>
        </tr>
    </thead>
    <?php foreach($buku as $row):?>
    <?php if ($row->status=='N'): ?>
        <tr>
            <td><?php echo $row->kode_buku;?></td>
            <td><?php echo $row->judul;?></td>
            <td><?php echo $row->pengarang;?></td>
            <td><button class="btn btn-primary btn-kembali" data-id="<?php echo $row->id_transaksi; ?>" data-buku="<?php echo $row->kode_buku; ?>"><i class="glyphicon glyphicon-saved"></i> Simpan</button></td>
        </tr>
    <?php endif ?>
    <?php endforeach;?>
</table>
<hr>
Telah Dikembalikan
<table class="table table-striped">
    <thead>
        <tr>
            <td>Kode Buku</td>
            <td>Judul Buku</td>
            <td>Pengarang</td>
        </tr>
    </thead>
    <?php foreach($buku as $row):?>
    <?php if ($row->status=='Y'): ?>
        <tr>
            <td><?php echo $row->kode_buku;?></td>
            <td><?php echo $row->judul;?></td>
            <td><?php echo $row->pengarang;?></td>
        </tr>
    <?php endif ?>
    <?php endforeach;?>
</table>
<script>
    (function($){
        $(".btn-kembali").click(function(){
            var no=$("#no").val();
            var nis=$("#nis").val();
            var buku = $(this).data('buku');
            console.log(buku);
            var denda=$("#denda").val();
            var nominal=parseInt($("#nominal").val());
            var no=$("#no").val();
            
            if (no=="" || nis=="") {
                alert("Pilih ID Transaksi");
                $("#no").focus();
                return false;
            }
            else if (denda=="rusak") {
                if (nominal=="") {
                    alert ("Masukkan Nominal Denda");
                    $("#nominal").focus();
                    return false;
                }else{
                    $.ajax({
                        url:"<?php echo site_url('pengembalian/simpan');?>",
                        type:"POST",
                        data:"no="+no+"&denda="+denda+"&nominal="+nominal+"&buku="+buku,
                        cache:false,
                        success:function(html){
                            $("#tampil").load("<?php echo site_url('pengembalian/tampil');?>","no="+no);
                        }
                    })
                }
            }else{
                $.ajax({
                    url:"<?php echo site_url('pengembalian/simpan');?>",
                    type:"POST",
                    data:"no="+no+"&denda="+denda+"&nominal="+nominal+"&buku="+buku,
                    cache:false,
                    success:function(html){
                        $("#tampil").load("<?php echo site_url('pengembalian/tampil');?>","no="+no);    
                    }
                })
            }
        })
    }(jQuery))
</script>