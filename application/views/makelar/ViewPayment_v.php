<section id="intro">
  <div class="jumbotron masthead">
    <div class="container">
      <h2>Payment List</h2>
      <table border="1" width="100%">
        <tr>
          <th width="5%">No</th>
          <th width="15%">Nama Pembayaran</th>
          <th width="15%">Nama User</th>
          <th width="10%">Jumlah</th>
          <th width="10%">Status</th>
          <th width="10%">Tanggal</th>
          <th width="15%">Bukti Pembayaran</th>
          <th width="10%">Action</th>
        </tr>
        <?php $i = 0; foreach ($list as $row) { $i++;?>
          <tr>
            <td style="text-align: center;">
              <?php echo $i; ?>
            </td>
            <td style="text-align: center;">
              <?php echo $row->judul; ?>
            </td>
            <td style="text-align: center;">
              <?php echo $row->nama; ?>
            </td>
            <td style="text-align: center;">
              <?php echo $row->amount; ?>
            </td>
            <td style="text-align: center;">
              <?php if ($row->status == 0) {
                echo "Menunggu Upload Bukti Pembayaran";
              } elseif ($row->status == 1) {
                echo "Menunggu Verifikasi Pembayaran";
              } elseif ($row->status == 2) {
                echo "Pembayaran Terverifikasi";
              } elseif ($row->status == 3) {
                echo "Menunggu Upload Ulang Pembayaran";
              } ?>
            </td>
            <td style="text-align: center;">
              <?php echo date_format(date_create($row->date_created), "jS F Y");; ?>
            </td>
            <td style="text-align: center;">
              <?php if ($row->status == 0) {
                echo "Belum mengupload bukti pembayaran";
              } else if ($row->status == 1) { ?>
              <a href="<?php echo base_url(). 'ApplicationCtl/buktiEditor/'.$row->id_pembayaran ?>">->Download Bukti Pembayaran<-</a>
            <?php } else if ($row->status == 2) {
              echo "Pembayaran Terverifikasi";
            } else {
              echo "Menunggu Upload Ulang Bukti Pembayaran";
            } ?>
            </td>
            <td style="text-align: center;">
              <?php if ($row->status == 1) { ?>
                <a href="<?php echo base_url() . 'MakelarCtl/accDc/2/'.$row->id_pembayaran; ?>">Accept Payment</a>
                ||
                <a href="<?php echo base_url() . 'MakelarCtl/accDc/3/'.$row->id_pembayaran; ?>">Reject Payment</a>
              <?php } elseif ($row->status == 2) {
                echo "Pembayaran Terverifikasi";
              } else {
                echo "- - - - -";
              }?>
            </td>
          </tr>
        <?php } ?>
      </table>
    </div>
  </div>
</section>