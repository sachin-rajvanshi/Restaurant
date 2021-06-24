<script type="text/javascript">
  function adminLogout(){
    swal({
      title: "Are you sure?",
      text: "Logout your account!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.location.href = '{{ route('admin.logout') }}';
      } else {
        
      }
    });
  }

  POSITION = ['top-right', 'top-left', 'top-center', 'bottom-right', 'bottom-left', 'bottom-center'];

  $.toastDefaults.position = 'top-right';
  $.toastDefaults.dismissible = true;
  $.toastDefaults.stackable = true;
  $.toastDefaults.pauseDelayOnHover = true;
</script>
<!-- toastr message -->
@if(session()->has('success'))
    <script>
        $.toast({
            type: 'success',
            title: 'Awesome!',
            subtitle: 'Now',
            content: '{{ session()->get('success') }}',
            delay: 8000,
            img: {
                src: '{{ asset('') }}images/success.jpg',
                alt: 'Success'
            }
        });
    </script>
@endif
@if(session()->has('warning'))
    <script>
      $.toast({
          type: 'warning',
          title: 'Watch Out!',
          subtitle: 'Now',
          content: '{{ session()->get('warning') }}',
          delay: 8000,
          img: {
              src: '{{ asset('') }}images/warning.jpg',
              alt: 'Warning'
          }
      });
    </script>
@endif
@if(session()->has('info'))
    <script>
        $.toast({
            type: 'info',
            title: 'Notice!',
            subtitle: 'Now',
            content: '{{ session()->get('info') }}',
            delay: 8000,
            img: {
                src: '{{ asset('') }}images/info.png',
                alt: 'Info'
            }
        });
    </script>
@endif
@if(session()->has('error'))
    <script>
        $.toast({
            type: 'error',
            title: 'Doh!',
            subtitle: 'Now',
            content: '{{ session()->get('error') }}',
            delay: 8000,
            img: {
                src: '{{ asset('') }}images/danger.jpg',
                alt: 'Danger'
            }
        });
    </script>
@endif
@if(count($errors) > 0 )
  @foreach($errors->all() as $error)
    <script>
        $.toast({
            type: 'error',
            title: 'Doh!',
            subtitle: 'Now',
            content: '{{ $error }}',
            delay: 12000,
            img: {
                src: '{{ asset('') }}images/danger.jpg',
                alt: 'Danger'
            }
        });
    </script>
  @endforeach
@endif
