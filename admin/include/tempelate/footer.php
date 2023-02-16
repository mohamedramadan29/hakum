  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
      <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
      <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
    </svg>
  </div>




  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="<?php echo $js; ?>jquery.PrintArea.js"></script>

  <!-- jQuery UI 1.11.4 -->
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>

  <!-- Bootstrap 4 -->
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js">
  </script>
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
  <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>-->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <!--<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>  -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <!-- jQUERY PLUGIN USED IN AJAX SEND DATA -->
  <!-- SCRIPT TO UPLOAD FILES  -->
  <script src="//oss.maxcdn.com/jquery.form/3.50/jquery.form.min.js"></script>
  <!-- START RATING SYSTEM -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

  <!-- END RATING SYSTEM -->
  <!-- popper js -->
  <script src="<?php echo $js; ?>popper.min.js"></script>
  <script src="https://kit.fontawesome.com/588e070751.js" crossorigin="anonymous"></script>
  <!-- Bootstrap -->


  <script src="<?php echo $js; ?>custome.js"></script>
  <script src="dist/js/adminlte.js"></script>
  <!-- START SEND DATA WITH AJAX -->
  <!-- START SCRIPT TO UPLOAD FILES  -->
 
<script>
    $(function() {
        let beat = new Audio('sound.wav');
        $(document).ready(function() {
            var percent = $('#percent');
            var status = $('.status');
            $('.ajax_form').ajaxForm({
                beforeSend: function() {
                    status.empty();
                    var percentVal = '0%';
                    percent.html(percentVal);
                },
                uploadProgress: function(event, position, total, percentComplete) {
                    var percentVal = percentComplete + '%';
                    percent.html(percentVal);

                    $("#percent").html(percentVal);
                    $("#percent").width(percentVal);
                },
                complete: function(xhr) {
                    status.html(xhr.responseText);
                    setTimeout(() => {
                        document.location.reload();
                    },0);
                }
            });
        });
    });
</script>

  <!-- END SEND DATA WITH AJAX -->
  </div>
  </div>
  </body>

  </html>