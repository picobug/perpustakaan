<?php if (isset($buku)): ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No.</th>
                <th>Kode Buku</th>
                <th>Judul</th>
                <th>Pengarang</th>
                <th>Klasifikasi</th>
                <th>Pesan Buku</th>
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
                <td><a href="#" class="btn btn-primary tambah" data-id="<?php echo $row->kode_buku; ?>"><i class="glyphicon glyphicon-plus-sign"></i></a></td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    <script>
    (function($){
        var simpan_buku = {
            init: function(){
                $('.tambah').on('click', function(event) {
                    event.preventDefault();
                    console.log('test');
                    if ($(this).hasClass('btn-primary')) {
                        $self = $(this);
                        $.post('<?php echo site_url("dashboard_nis/simpan_pesan");?>',
                            {kode_buku: $self.data('id')},
                            function(data, textStatus, xhr) {
                                data = JSON.parse(data);
                                if (data.status) {
                                    $self.removeClass('btn-primary').addClass('btn-success disabled').children('i').removeClass('glyphicon-plus-sign').addClass('glyphicon-ok-sign');
                                } else {
                                    alert('Buku telah di pesan sebelumnya');
                                };
                        });
                    } else {
                        return;
                    };
                });
            }
        };
        simpan_buku.init();
    }(jQuery));
    </script>
<?php else: ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            Cari Buku
        </div>
        <div class="panel-body">
            <div class="input-buku">
                <div class="form-inline">
                    <div class="form-group">
                        <label for="cari_buku">Cari Buku</label>
                        <input type="text" name="cari" class="form-control" id="cari_buku">
                    </div>
                    <div class="form-group">
                        <label class="sr-only">Cari</label>
                        <button class="btn btn-primary">Cari</button>
                    </div>
                </div>
            </div>
            <div class="data-buku"></div>
        </div>
    </div>
    <script>
    (function($){
        var pesan_buku = {
            ajax: function(){
                $cari = function(){
                    return $('#cari_buku').val();
                };
                $.post('<?php echo site_url("dashboard_nis/pesan_buku");?>',
                    {cari: $cari()},
                    function(data, textStatus, xhr) {
                        $('.data-buku').html(data);
                });
            },
            init: function(){
                var self = this;
                $('.input-buku .btn').on('click', function(event) {
                    event.preventDefault();
                    if ($('#cari_buku').val()) {
                        self.ajax();
                    } else {
                        alert('Masukkan kata kunci pencarian');
                    };
                });
            }
        };
        pesan_buku.init();
    }(jQuery));
    </script>
<?php endif ?>