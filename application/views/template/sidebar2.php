<div class="panel-group" id="accordion">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><span class="glyphicon glyphicon-folder-close">
                </span> Master</a>
            </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse in">
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <td>
                            <span class="glyphicon glyphicon-pencil text-primary"></span> <a href="<?php echo site_url('dashboard_nis/lihat_buku');?>">Lihat Buku</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="glyphicon glyphicon-book text-success"></span> <a href="<?php echo site_url('dashboard_nis/pesan_buku');?>">Pesan Buku</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a href="<?php echo site_url('dashboard_nis/logout');?>"><span class="glyphicon glyphicon-off">
                </span> Logout</a>
            </h4>
        </div>
    </div>
</div>