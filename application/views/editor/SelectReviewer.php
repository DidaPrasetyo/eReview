<section id="intro">
  <div class="jumbotron masthead">
    <div class="container">
      <h2>Reviewer List</h2>
      <form id="form" action="<?php echo base_url().'EditorCtl/selectingReviewer' ?>" method="POST">
        <table border="1" width="100%">
          <tr>
            <th width="5%">No</th>
            <th width="25%">Nama</th>
            <th width="20%">Email</th>
            <th width="30%">Kompetensi</th>
            <th width="15%">Status</th>
            <th width="5%">Pilih</th>
          </tr>
          <?php $i = 0; foreach ($reviewer as $row) { $i++;?>
            <tr>
              <td><?php echo $i; ?></td>
              <td><?php echo $row->nama; ?></td>
              <td><?php echo $row->email; ?></td>
              <td><?php echo $row->kompetensi; ?></td>
              <td style="text-align: center">
                <?php if ($row->sts_user == 1) {
                  echo "Active";
                } else {
                  echo "Inactive";
                } ?></td>
                <td style="text-align: center"><input type="checkbox" name="select[]" id="select[]" value="<?php echo $row->id_reviewer;?>"></td>
              </tr>
            <?php } ?>
          </table>
          <input type="hidden" name="id_task" value="<?php echo $id_task; ?>">
          <div style="float: left;">
            <label for="page">Jumlah halaman jurnal</label>
            <input type="number" id="page" name="page" value="<?php echo $pageTask; ?>" readonly>
            <label for="pagePrice">Harga per halaman</label>
            <input type="number" id="pagePrice" name="pagePrice" value="15000" readonly>
            <label for="price">Harga per Reviewer</label>
            <input type="number" id="price" name="price" readonly>
            <label class="label" id="jml">0</label>
            <label for="total">Total (Harga x Jumlah Reviewer)</label>
            <input type="number" id="total" name="total" readonly>
          </div>
          <br>
          <input class="btn" id="submit" style="float: right;" type="submit" name="submit" value="Submit">
        </form>
      </div>
    </div>
  </section>
  <script type="text/javascript">
      var a = document.getElementById("page").value;
      var b = document.getElementById("pagePrice").value;
      document.getElementById("price").value = a*b;
    document.getElementById("form").addEventListener("click",function(){
      var x = document.querySelectorAll('input[type="checkbox"]:checked').length;
      document.getElementById("jml").innerHTML = x;
      var y = document.getElementById("price").value;
      document.getElementById("total").value = x*y;
    });
    document.getElementById("form").addEventListener('submit', (e) => {
      var x = document.getElementById("page").value;
      if (x == 0) {
        alert("Masukkan Jumlah Halaman terlebih dahulu");
        e.preventDefault()
      }
    });
  </script>