<section id="intro">
  <div class="jumbotron masthead">
    <div class="container">
      <h2>My Task List</h2>
      <table border="1" width="100%">
        <tr>
          <th width="5%">No</th>
          <th width="15%">Title</th>
          <th width="15%">Keywords</th>
          <th width="15%">Download Journal</th>
          <th width="10%">Date Assigned</th>
          <th width="10%">Deadline</th>
          <th width="15%">Status</th>
          <th width="20%">Action</th>
        </tr>
        <?php $i = 0; foreach ($tasks as $item) { $i++;?>
          <tr>
            <td style="text-align: center;"><?php echo $i; ?></td>
            <td style="text-align: center;"><?php echo $item['judul']; ?></td>
            <td style="text-align: center;"><?php echo $item['keywords']; ?></td>
            <td style="text-align: center;"> <a href="<?php echo base_url() . 'ApplicationCtl/Download/' . $item['id_task'] ?>" target="_blank">->Download-<</a></td>
            <td style="text-align: center;"><?php echo date_format(date_create($item['tgl_assign']), "jS F Y");; ?></td>
            <td style="text-align: center;"><?php echo date_format(date_create($item['tgl_deadline']), "jS F Y");; ?></td>
            <td style="text-align: center;">
              <?php if ($item['status'] == 1) {
                echo "Waiting Reviewer Decision";
              } elseif ($item['status'] == 2) {
                echo "Accepted";
              } elseif ($item['status'] == 3) {
                echo "Declined";
              } elseif ($item['status'] == 4) {
                echo "Submitted";
              } elseif ($item['status'] == 5) {
                echo "Editor reject the result. Please re-review";
              } elseif ($item['status'] == 6) {
                echo "Your result Accepted by editor";
              } ?>
            </td>
            <td style="text-align: center;">
              <?php if ($item['status'] == 1) { ?>
              <a href="<?php echo base_url() . 'ReviewerCtl/accDc/2/'. $item['id_assign'] ?>">ACCEPT</a>
            ||
              <a href="<?php echo base_url() . 'ReviewerCtl/accDc/3/'. $item['id_assign'] ?>">DECLINE</a>
            <?php } elseif ($item['status'] == 2 || $item['status'] == 5) { ?>
              <form id="form" action="<?php echo base_url().'ReviewerCtl/uploadReview/'.$item['id_assign']; ?>" method="post" enctype="multipart/form-data">
                  <input type="file" name="<?php echo 'berkas'.$item['id_assign']; ?>" id="<?php echo 'berkas'.$item['id_assign']; ?>">
                  <input class="btn" id="submit" style="float: right;" type="submit" name="submit" value="Submit">
                </form>
            <?php } elseif ($item['status'] == 3) {
              echo "Task Declined";
            } elseif ($item['status'] == 4) {
              echo "Done Submit";
            } elseif ($item['status'] == 6) {
              echo "Task Done";
            } ?></td>
          </tr>
        <?php } ?>
      </table>
    </div>
  </div>
</section>