<section id="intro">
  <div class="jumbotron masthead">
    <div class="container">
      <h2>Saldo Information</h2>
      <br>
      <table border="1" width="50%">
        <tr>
          <th width="10%">No</th>
          <th width="25%">Uang Masuk</th>
          <th width="25%">Uang Keluar</th>
          <th width="25%">Total</th>
          <th width="15%">Keterangan</th>
        </tr>
        <?php $i = 0; foreach ($saldo as $row) { $i++;?>
          <tr>
            <td style="text-align: center;"><?php echo $i; ?></td>
            <td style="text-align: center;"><?php echo "Rp " . number_format($row->masuk,2,',','.'); ?></td>
            <td style="text-align: center;"><?php echo "Rp " . number_format($row->keluar,2,',','.'); ?></td>
            <td style="text-align: center;"><?php echo "Rp " . number_format($row->total,2,',','.'); ?></td>
            <td style="text-align: center;"><?php echo $row->ket; ?></td>
          </tr>
        <?php } ?>
      </table>
      <br>
      <h2>Payment Information</h2>
      <br>
      <table border="1" width="50%">
        <tr>
          <th width="10%">No</th>
          <th width="20%">Jumlah</th>
          <th width="25%">Status</th>
          <th width="20%">Keterangan</th>
          <th width="25%">Action</th>
        </tr>
        <?php if(sizeof($payment) == 0){
          echo "Tidak Ada Riwayat Pembayaran";
        }
        $i = 0; foreach ($payment as $row) { $i++;?>
          <tr>
            <td style="text-align: center;"><?php echo $i; ?></td>
            <td style="text-align: center;"><?php echo "Rp " . number_format($row->amount,2,',','.'); ?></td>
            <td style="text-align: center;"><?php echo $row->status; ?></td>
            <td style="text-align: center;"><?php echo $row->id_task; ?></td>
            <td style="text-align: center;"><a href="">->Download Bukti<-</a></td>
          </tr>
        <?php } ?>
      </table>
    </div>
  </div>
</section>