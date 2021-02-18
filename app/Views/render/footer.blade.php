</div>
</section>
</div>
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
  <!-- <div class="p-3">
    <h5>Title</h5>
    <p>Sidebar content</p>
  </div> -->
</aside>
<!-- /.control-sidebar -->

<!-- Main Footer -->
<footer class="main-footer">
  <!-- To the right -->
  <div class="float-right d-none d-sm-inline">
    <strong>
      <a target="_blank" href="https://github.com/ffegu">Ffegu</a>
    </strong>
  </div>
  <!-- Default to the left -->
  <strong>&copy; <?= date('Y') ?> <a href="<?= config('Boilerplate')->theme['footer']['vendorlink'] ?>"><?= config('Boilerplate')->theme['footer']['vendorname']?></a>.</strong> All rights reserved.
</footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.0.4/dist/js/adminlte.min.js"></script>
<script>
$('.sidebar-toggle').on('click',function(event){event.preventDefault();if(Boolean(sessionStorage.getItem('sidebar-toggle-collapsed'))){sessionStorage.setItem('sidebar-toggle-collapsed','')}else{sessionStorage.setItem('sidebar-toggle-collapsed','1')}});(function(){if(Boolean(sessionStorage.getItem('sidebar-toggle-collapsed'))){var body=document.getElementsByTagName('body')[0];body.className=body.className+' sidebar-collapse'}})()
</script>
@yield('pre-js')
@yield('js')
<script>
$.ajaxSetup({headers:{'{{ config('App')->CSRFHeaderName }}':$('meta[name="{{ config('App')->CSRFTokenName }}"]').attr('content')}})
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.7.2/dist/sweetalert2.all.min.js"></script>
<script>
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
});

<?php if (session('sweet-success')) { ?>
  Toast.fire({
    icon: 'success',
    title: '<?= session('sweet-success.') ?>'
  });
<?php } ?>
<?php if (session('sweet-warning')) { ?>
  Toast.fire({
    icon: 'warning',
    title: '<?= session('sweet-warning.') ?>'
  });
<?php } ?>
<?php if (session('sweet-error')) { ?>
  Toast.fire({
    icon: 'error',
    title: '<?= session('sweet-error.') ?>'
  });
<?php } ?>
</script>
</body>

</html>
