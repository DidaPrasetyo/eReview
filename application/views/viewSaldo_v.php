<section id="intro">
  <div class="jumbotron masthead">
    <div class="container">
      <h2>Saldo Information</h2>
      <button type="button" class="btn" data-toggle="modal" data-target="#Modal1">Isi Saldo</button>
      <button type="button" class="btn" data-toggle="modal" data-target="#Modal2">Penarikan</button>
      <br>
      <br>
      <table border="1" width="50%">
        <tr>
          <th width="10%">No</th>
          <th width="20%">Uang Masuk</th>
          <th width="20%">Uang Keluar</th>
          <th width="25%">Total</th>
          <th width="25%">Keterangan</th>
        </tr>
        <?php if(sizeof($saldo) == 0){
          echo "<p>Tidak Ada Riwayat Saldo</p>";
        } else {
          $i = 0; foreach ($saldo as $row) { $i++;?>
            <tr>
              <td style="text-align: center;"><?php echo $i; ?></td>
              <td style="text-align: center;"><?php echo "Rp " . number_format($row->masuk,2,',','.'); ?></td>
              <td style="text-align: center;"><?php echo "Rp " . number_format($row->keluar,2,',','.'); ?></td>
              <td style="text-align: center;"><?php echo "Rp " . number_format($row->total,2,',','.'); ?></td>
              <td style="text-align: center;">
                <?php if ($row->ket == 1) {
                  echo "Pengembalian Dana Task";
                } elseif ($row->ket == 2) {
                  echo "Gaji Hasil Review";
                } elseif ($row->ket == 3) {
                  echo "Pengisian Saldo";
                } elseif ($row->ket == 4) {
                  echo "Penarikan Saldo";
                } ?>
                </td>
            </tr>
          <?php }} ?>
        </table>
        <br>
        <h2>Payment Information</h2>
        <br>
        <table border="1" width="50%">
          <tr>
            <th width="5%">No</th>
            <th width="20%">Jumlah</th>
            <th width="25%">Status</th>
            <th width="25%">Keterangan</th>
            <th width="25%">Action</th>
          </tr>
          <?php if(sizeof($payment) == 0){
            echo "<p>Tidak Ada Riwayat Pembayaran</p>";
          } else {
            $i = 0; foreach ($payment as $row) { $i++;?>
              <tr>
                <td style="text-align: center;"><?php echo $i; ?></td>
                <td style="text-align: center;"><?php echo "Rp " . number_format($row->amount,2,',','.'); ?></td>
                <td style="text-align: center;">
                  <?php if ($row->status == 0) {
                    echo "Belum mengupload Bukti Bayar";
                  } else if ($row->status == 1) {
                    echo "Menunggu Verifikasi Makelar";
                  } elseif ($row->status == 2) {
                    echo "Transaksi Berhasil";
                  } ?>
                  </td>
                <td style="text-align: center;"><?php echo 'Transaksi '.$row->judul; ?></td>
                <td style="text-align: center;">
                  <?php if ($row->status == 1) { ?>
                  <a href="" class="btn btn-link">Download Bukti</a>
                  <?php } else{
                    echo "- - - - -";
                  } ?>
                </td>
              </tr>
            <?php }} ?>
          </table>
          <br>
          <h2>Deduct Fund Information</h2>
          <br>
          <table border="1" width="50%">
            <tr>
              <th width="10%">No</th>
              <th width="25%">Jumlah</th>
              <th width="35%">Status</th>
              <th width="30%">Bukti Transfer</th>
            </tr>
            <?php if(sizeof($deduct) == 0){
              echo "<p>Tidak Ada Riwayat Penarikan</p>";
            }
            $i = 0; foreach ($deduct as $row) { $i++;?>
              <tr>
                <td style="text-align: center;"><?php echo $i; ?></td>
                <td style="text-align: center;"><?php echo "Rp " . number_format($row->amount,2,',','.'); ?></td>
                <td style="text-align: center;">
                  <?php if ($row->status == 1) {
                    echo "Menunggu Transfer dari Makelar";
                  } else { 
                    echo "Transaksi Selesai";
                  }?>
                </td>
                <td style="text-align: center;">
                  <?php if ($row->status == 1) {
                    echo "- - - - -";
                  } else { ?>
                    <a href="" class="btn btn-link">Download Bukti</a>
                  <?php } ?>
                </td>
              </tr>
            <?php } ?>
          </table>
        </div>
      </div>
    </section>

    <!-- Modal -->
    <div id="Modal1" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Isi Saldo</h3>
      </div>
      <form action="<?php echo base_url().'AccountCtl/isiSaldo' ?>" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <label for="jumlah">Jumlah</label>
          <input id="jumlah" type="number" name="jumlah">
          <label for="bukti">Bukti Pembayaran</label>
          <input type="file" id="bukti" name="bukti">
        </div>
        <div class="modal-footer">
          <button class="btn" data-dismiss="modal" aria-hidden="true">Cancle</button>
          <button class="btn btn-primary" id="Submit" type="Submit" name="Submit">Submit</button>
        </form>
      </div>
    </div>

    <div id="Modal2" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Penarikan Saldo</h3>
      </div>
      <form id="form" action="<?php echo base_url().'AccountCtl/penarikan' ?>" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div>
            <button class="btn btn-primary" disabled>
              Saldo Akun : <?php echo "Rp " . number_format($akun,2,',','.'); ?>
              <input type="number" id="saldo_akun" name="saldo_akun" value="<?php echo $akun ?>" style="display: none;">
            </button>
          </div>
          <br>
          <label for="jumlah">Nominal Penarikan</label>
          <input id="jumlah_tarik" type="number" name="jumlah_tarik" value="0">
          <label for="no_rek">Nomor Rekening</label>
          <input id="no_rek" type="number" name="no_rek" value="<?php echo $no_rek->no_rek;?>">
          <p><span style="color: red;">*</span>Cek kembali nomer rekening anda!</p>
        </div>
        <div class="modal-footer">
          <button class="btn" data-dismiss="modal" aria-hidden="true">Cancle</button>
          <button class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>

    <script type="text/javascript">
      document.getElementById("form").addEventListener('submit', (e) => {
        var a = parseInt(document.getElementById('saldo_akun').value);
        var b = parseInt(document.getElementById('jumlah_tarik').value);
        if (b > a) {
          alert("Jumlah Penarikan tidak boleh melebihi jumlah saldo anda!");
          e.preventDefault()
        } else if (b == 0) {
          alert("Masukkan jumlah uang yang ingin anda tarik!");
          e.preventDefault()
        }
      });
    </script>