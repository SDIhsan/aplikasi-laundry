

</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
<div class="container my-auto">
<div class="copyright text-center my-auto">
  <span>Copyright &copy; Aplikasi Pengelolaan Laundry <?= date('Y') ?></span>
</div>
</div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body"><center><img src="<?= url('assets/img/undraw_Login_re_4vu2.svg') ?>" alt="" style="width: 400px;"></center></div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-danger" href="<?= url('logout.php') ?>">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Yakin Ingin Menghapus Data Tersebut?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Pilih "Delete" jika ingin melanjutkan menghapus!</div>
            <div class="modal-footer">
                <button class="btn btn-success" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger" href="#" id="modalDelete">Delete</a>
            </div>
        </div>
    </div>
</div>
<script>
    $('.delete').click(function(){
        var id=$(this).data('id');
        $('#modalDelete').attr('href','delete.php?id='+id);
    })
</script>

  <!-- Bootstrap core JavaScript-->
  <script src="<?= url('assets/') ?>vendor/jquery/jquery.min.js"></script>
  <script src="<?= url('assets/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= url('assets/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= url('assets/') ?>js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="<?= url('assets/') ?>vendor/chart.js/Chart.min.js"></script>
  <script src="<?= url('assets/') ?>vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= url('assets/') ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <!-- <script src="<?= url('assets/') ?>js/demo/chart-area-demo.js"></script> -->
  <!-- <script src="<?= url('assets/') ?>js/demo/chart-pie-demo.js"></script> -->
  <script src="<?= url('assets/') ?>js/demo/datatables-demo.js"></script>

</body>

</html>
