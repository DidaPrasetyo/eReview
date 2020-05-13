<section id="intro">
  <div class="jumbotron masthead">
    <div class="container">
      <h2>My Assignment List</h2>
      <table border="1" width="100%">
        <tr>
          <th width="5%">No</th>
          <th width="15%">Nama Reviewer</th>
          <th width="15%">Title Task</th>
          <th width="10%">Date Assigned</th>
          <th width="10%">Deadline</th>
          <th width="10%">Price</th>
          <th width="15%">Status</th>
          <th width="25%">Action</th>
        </tr>
        <?php $i = 0; foreach ($tasks as $item) { $i++;?>
          <tr>
            <td style="text-align: center;">
              <?php echo $i; ?>
            </td>
            <td style="text-align: center;">
              <?php echo $item['nama']; ?>
            </td>
            <td style="text-align: center;">
              <?php echo $item['judul']; ?>
            </td>
            <td style="text-align: center;">
              <?php echo date_format(date_create($item['tgl_assign']), "jS F Y"); ?>
              <!-- <a href="<?php echo base_url() . 'ApplicationCtl/Download/' . $item['id_task'] ?>" target="_blank">->Download-<</a> -->
            </td>
            <td style="text-align: center;">
              <?php echo date_format(date_create($item['tgl_deadline']), "jS F Y"); ?>
            </td>
            <td style="text-align: center;">
              <?php echo "Rp " . number_format($item['price'],2,',','.'); ?>
            </td>
            <td style="text-align: center;">
              <?php if ($item['status'] == 1) {
                echo "Waiting Reviewer Decision";
              } elseif ($item['status'] == 2) {
                echo "Accepted by Reviewer";
              } elseif ($item['status'] == 3) {
                echo "Declined by Reviewer";
              } elseif ($item['status'] == 4 || $item['status'] == 6) {
                echo "Done Reviewed";
              } elseif ($item['status'] == 5) {
                echo "Review Rejected";
              } elseif ($item['status'] == 7) {
                echo "Waiting Makelar Verification";
              }?>
            </td>
            <td style="text-align: center;">
              <?php if ($item['status'] == 1) { 
                echo "Waiting Reviewer Decision";
              } elseif ($item['status'] == 2 || $item['status'] == 5) { 
                echo "Waiting Reviewer Upload Result";
              } elseif ($item['status'] == 3) {
                echo "Task Declined";
              } elseif ($item['status'] == 4) { ?>
                <a href="<?php echo base_url() . 'EditorCtl/accDc/6/'. $item['id_assign'].'/' .$item['id_reviewer'] ?>">Accept Result</a>
                ||
                <a href="<?php echo base_url() . 'EditorCtl/accDc/5/'. $item['id_assign'].'/' .$item['id_reviewer']?>">Reject Result</a>
                <br>
                <a href="<?php echo base_url(). 'ApplicationCtl/downReview/'.$item['id_assign']; ?>">->Download Reviewed Article<-</a>
                <?php } elseif ($item['status'] == 6) {
                  echo "You Accepted the Review. Task Done";
                } ?></td>
              </tr>
            <?php } ?>
          </table>
        </div>
      </div>
    </section>