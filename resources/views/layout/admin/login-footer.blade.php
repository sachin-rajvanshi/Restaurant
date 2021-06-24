
<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

<footer class="footer footer-static footer-light">
  <p class="clearfix mb-0 text-center"><span class="d-block d-md-inline-block mt-25">Copyright  &copy; 2021<a class="ml-25" href="#" target="_blank">Restaurant</a> | <span class="d-sm-inline-block"> All rights Reserved.</span></span>
  </p>
</footer>

<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>

<script src="{{ asset('') }}admin/js/jquery.min.js"></script>
<script src="{{ asset('') }}admin/js/jquery.sticky.js"></script>
<script src="{{ asset('') }}admin/js/bs-stepper.min.js"></script>
<script src="{{ asset('') }}admin/js/select2.full.min.js"></script>
<script src="{{ asset('') }}admin/js/apexcharts.min.js"></script>
<script src="{{ asset('') }}admin/js/flatpickr.min.js"></script>
<script src="{{ asset('') }}admin/js/app-menu.min.js"></script>
<script src="{{ asset('') }}admin/js/app.min.js"></script>
<script src="{{ asset('') }}admin/js/chart-apex.min.js"></script>
<script src="{{ asset('') }}admin/js/form-select2.min.js"></script>
<script src="{{ asset('') }}admin/js/custom.js"></script>
<script src="{{ asset('') }}admin/js/ckeditor.js"></script>
<script>
	DecoupledEditor
	.create( document.querySelector( '#editor' ), {
		// toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
	} )
	.then( editor => {
		const toolbarContainer = document.querySelector( '.toolbar-container' );

		toolbarContainer.prepend( editor.ui.view.toolbar.element );

		window.editor = editor;
	} )
	.catch( err => {
		console.error( err.stack );
	} );
</script>
</body>

</html>