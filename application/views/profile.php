  <section id="intro">
  </section>
  <section id="maincontent">
    <div class="container">
      <div class="row">
        <div class="span12">
          <div class="tagline centered">
            <div class="row">
              <div class="span12">
                <div class="tagline_text">
                  <h2>Profile Page</h2>
                  <div>
                    <button class="btn btn-primary" disabled>Saldo Akun : <?php echo "Rp " . number_format($saldo,2,',','.'); ?></button>
                    <a href="<?php echo base_url().'AccountCtl/viewSaldo/'.$user['id'] ?>" class="btn">Detail</a>
                  </div>
                  <p>
                    <?php if (strlen($error)>0) {
                      echo '<span style="color: red">'.$error.'</span>';
                    } ?>
                  </p>
                  <div align="center">
                    <table>
                      <tr>
                        <td width="66%">
                          <form action="<?php echo base_url()."AccountCtl/updateProfile"?>" method="post" enctype="multipart/form-data">
                            <table>
                              <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td><input type="text" id="nama" name="nama" width="100" value="<?php echo $user['nama'] ?>"/></td>
                              </tr>
                              <tr>
                                <td>Username</td>
                                <td>:</td>
                                <td><input type="text" id="username" name="username" width="100" value="<?php echo $user['username'] ?>"/></td>
                              </tr>
                              <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td><input type="text" id="email" name="email" width="100" value="<?php echo $user['email'] ?>"/></td>
                              </tr>
                              <tr>
                                <td>Roles</td>
                                <td>:</td>
                                <td>
                                  <?php foreach ($roles as $role) {
                                    echo ucwords($role['nama_grup'] ." ");
                                  } ?>
                                </td>
                              </tr>
                              <tr>
                                <td>Photo</td>
                                <td>:</td>
                                <td>
                                  <label for="photo"><?php echo $user['photo'] ?></label>
                                  <input type="file" id="photo" name="photo" width="100"/>
                                </td>
                              </tr>
                            </table>

                            <button style="float: right;" class="btn" type="submit" value="Submit">Update</button>
                          </form>
                        </td>
                        <td width="34%">
                          <img src="<?php echo base_url().'/photos/'.$user['photo'] ?>" width="150" height="200">
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- end tagline -->
        </div>
      </div>
    </div>
  </section>