<style>
    .glyphicons {
        padding-left: 0;
        padding-bottom: 1px;
        margin-bottom: 20px;
        list-style: none;
        overflow: hidden;
      }
          
      .glyphicons li {
        float: left;
        width: 11.5%;
        height: 115px;
        padding: 10px;
        margin: 0 -1px -1px 0;
        font-size: 12px;
        line-height: 1.4;
        text-align: center;
        border: 1px solid #ddd;
      }
      
      .glyphicons .glyphicon {
              margin-top: 5px;
              margin-bottom: 10px;
              font-size: 24px;
          display: block;
              text-align: center;
      }
</style>
<div class="panel panel-default">
    <div class="panel-heading">
        Welcome : <?php echo ucfirst($anggota->nama); ?>
    </div>
    <div class="panel-body">
        <?php $book = $this->session->flashdata('message'); $book_array = json_decode($book,true); ?>
        <?php if ($book && !empty($book_array)): ?>
          <table class="table">
            <thead>
              <tr>
                <th>Buku Pesanan</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($book_array as $val): ?>
                <tr>
                  <td><?php echo $val['judul'] ?></td>
                  <td><?php echo $val['status'] ?></td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        <?php endif ?>
        <div class="container">
            <ul class="glyphicons">
                <li>
                  <span class="glyphicon glyphicon-book"></span>
                  <a href="<?php echo site_url('dashboard_nis/lihat_buku');?>">LIhat Buku</a>
                </li>
                
                <li>
                  <span class="glyphicon glyphicon-save"></span>
                  <a href="<?php echo site_url('dashboard_nis/pesan_buku');?>">Pesan Buku</a>
                </li>
                <li>
                  <span class="glyphicon glyphicon-off"></span>
                  <a href="<?php echo site_url('dashboard_nis/logout');?>">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</div>