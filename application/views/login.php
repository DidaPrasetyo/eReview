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
                <h2>Please Login</h2>
                <p>
                  You should login to the system before you can submit or review any article.
                </p>
                <div align="center">
                  <form action="<?php echo base_url()."AccountCtl/checkingLogin"?>" method="post">

                    <table>
                      <tr>
                        <td>Username</td>
                        <td>:</td>
                        <td><input type="text" id="username" name="username" width="100"/></td>
                      </tr>
                      <tr>
                        <td>Password</td>
                        <td>:</td>
                        <td><input type="password" id="password" name="password" width="100"/></td>
                      </tr>
                    </table>

                    <input type="submit" value="Login">
                  </form>
                  <p>If you haven't have an account, please <a href="<?php echo base_url(). 'welcome/signup'?>"> Sign-Up</p>
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