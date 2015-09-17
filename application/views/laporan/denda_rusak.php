<?php if (isset($denda_rusak)): ?>
    <legend><?php echo $title;?></legend>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No.</th>
                <th>Transaksi</th>
                <th>Tanggal Pengembalian</th>
                <th>Status</th>
                <th>Denda</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=0; foreach($denda_rusak as $row): $no++;?>
            <tr>
                <td><?php echo $no;?></td>
                <td><?php echo $row->id_transaksi;?></td>
                <td><?php echo $row->tgl_pengembalian;?></td>
                <td><?php echo $row->denda;?></td>
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
<?php else: ?>
    <script>
        $(function(){
            $("#tampilkan").click(function(){
                var tanggal1=$("#tanggal1").val();
                var tanggal2=$("#tanggal2").val();
                
                $.ajax({
                    url:"<?php echo site_url('laporan/denda_rusak');?>",
                    type:"POST",
                    data:"tanggal1="+tanggal1+"&tanggal2="+tanggal2,
                    cache:false,
                    success:function(html){
                        $("#tampil").html(html);
                    }
                })
            })
        })
    </script>

    <legend><?php echo $title;?></legend>
    <div class="form-horizontal">
        <div class="form-group">
            <label class="col-lg-3">Tanggal Awal</label>
            <div class="col-lg-5">
                <input type="text" id="tanggal1" class="form-control">
            </div>
        </div>
        
        <div class="form-group">
            <label class="col-lg-3">Tanggal Selesai</label>
            <div class="col-lg-5">
                <input type="text" id="tanggal2" class="form-control">
            </div>
            
            <div class="col-lg-4">
                <button id="tampilkan" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i> Tampilkan</button>
            </div>
        </div>
    </div>

    <div id="tampil"></div>
<?php endif ?>