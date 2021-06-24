@php
  $header = App\Models\Header::first();
  $footer = App\Models\Footer::first();
@endphp

<div id="cart-model-data"></div>

<footer>
  <div class="footer-area footer-bg">
    <div class="container">
      <div class="footer-top footer-padding">
        <div class="footer-heading">
          <div class="row justify-content-between">
            <div class="col-xl-6 col-lg-7 col-md-10">
              <div class="footer-tittle2">
                <h4>Download Apps</h4>
              </div>
              <div class="footer-app-link mb-5">
                <a href="#"><img src="{{ asset('') }}/assets/img/app-play.png" alt=""></a>
                <a href="#"><img src="{{ asset('') }}/assets/img/app-play.png" alt=""></a>
              </div>
            </div>
            <div class="col-xl-5 col-lg-5">
              <div class="footer-tittle2">
                <h4>Let’s Get Social</h4>
              </div>
              @if($footer->social_permission == 'Yes')
                <div class="footer-social mb-5">
                  <a href="{{ $header->facebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                  <a href="{{ $header->twitter }}" target="_blank"><i class="fab fa-twitter"></i></a>
                 <!--  <a href="" target="_blank"><i class="fab fa-google"></i></a> -->
                  <a href="{{ $header->linkedin }}" target="_blank"><i class="fab fa-instagram"></i></a>
                  <a href="{{ $header->youtube }}" target="_blank"><i class="fab fa-youtube"></i></a>
                </div>
              @endif
            </div>
          </div>
        </div>
        <div class="row d-flex justify-content-between">
          <div class="col-md-4 col-sm-6">
            <div class="single-footer-caption mb-50">
              <div class="footer-tittle">
                <h4>About Us</h4>
                <p>{{ $footer->about }}</p>
              </div>
            </div>
          </div>
          <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
            <div class="single-footer-caption mb-50">
              <div class="footer-tittle">
                <h4>Company</h4>
                <ul>
                  <li><a href="about.php">About Us</a></li>
                  <li><a href="career.php">Careers</a></li>
                  <li><a href="blog.php">News</a></li>
                  <li><a href="contact.php">Contact</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
            <div class="single-footer-caption mb-50">
              <div class="footer-tittle">
                <h4>Quick Links</h4>
                <ul>
                  <li><a href="gallery.php">Photo Galleries</a></li>
                  <li><a href="media-reviews.php">Media Reviews</a></li>
                  <li><a href="guest-reviews.php">Guest Reviews</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
            <div class="single-footer-caption mb-50">
              <div class="footer-tittle">
                <h4>Company Policy</h4>
                <ul>
                  <li><a href="{{ url('policy') }}">Privacy</a></li>
                  <li><a href="{{ url('terms') }}">Terms</a></li>
                  <li><a href="{{ url('refund/content') }}">Refund Policy</a></li>
                  <li><a href="{{ url('shipping') }}">Shipping Policy</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="footer-bottom">
        <div class="row d-flex align-items-center">
          <div class="col-lg-12">
            <div class="footer-copy-right text-center">
              <p>
                {{ $footer->copyright }}
              </p>
              <p>{{ $footer->address }} | {{ $header->phone_number }}</p>
              <p>Design & Developed by <a href="https://www.webmingo.in/" target="_blank">Web Mingo IT Solutions Pvt. Ltd.</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>

<div id="back-top">
  <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
</div>
<script type="text/javascript">
    document.getElementById('loading').style.display = 'none';
    //-------------------- Get state By country --------------------//

      function getState(country_id = null) {
          var country_id = $('#country').val() ? $('#country').val() : country_id;
          $("#state").html('');
          $.ajax({
              url:"{{url('get/states')}}/"+country_id,
              type: "GET",
              dataType : 'json',
              beforeSend: function() {
              document.getElementById('loading').style.display = 'block';
          },
          success: function(result) {
              $('#state').html('<option value="">Select State</option>');
                  $.each(result.data,function(key,state){
                      if(parseInt('{{ old('state') }}') == parseInt(state.id)) {
                          $("#state").append('<option value="'+state.id+'" selected>'+state.name+'</option>');
                      }else {
                          $("#state").append('<option value="'+state.id+'" >'+state.name+'</option>');
                      }
                  });
            },
            error: function(response) {
              document.getElementById('loading').style.display = 'none';
            },
            complete: function() {
              document.getElementById('loading').style.display = 'none';
            }
          });
      }

      //-------------------- Get city By state --------------------//

      function getCity(city_id = null) {
          var state_id = $('#state').val() ? $('#state').val() : city_id;
          $("#city").html('');
          $.ajax({
              url:"{{url('get/cities/')}}/"+state_id,
              type: "GET",
              dataType : 'json',
              beforeSend: function() {
              document.getElementById('loading').style.display = 'block';
          },
          success: function(result) {
              $('#city').html('<option value="">Select City</option>');
                  $.each(result.data,function(key,city){
                      if(parseInt('{{ old('city') }}') == parseInt(city.id)) {
                          $("#city").append('<option value="'+city.id+'" selected>'+city.name+'</option>');
                      }else {
                          $("#city").append('<option value="'+city.id+'" >'+city.name+'</option>');
                      }
                  });
            },
            error: function(response) {
              document.getElementById('loading').style.display = 'none';
            },
            complete: function() {
              document.getElementById('loading').style.display = 'none';
            }
          });
      }

      //-------------------- Get Sub Category --------------------//

      function getSubCategories(cat_id = null) {
          var new_cat_id = $('#category').val() ? $('#category').val() : cat_id;
          $("#sub_category").html('');
          $.ajax({
              url:"{{url('sub/categories')}}/"+new_cat_id,
              type: "GET",
              dataType : 'json',
              beforeSend: function() {
              document.getElementById('loading').style.display = 'block';
          },
          success: function(result) {
              if(result.data.length > 0) {
                $('#sub_category').html('<option value="">Select Sub Category</option>');
                $.each(result.data,function(key,sub_cat){
                    if(parseInt('{{ old('sub_cat') }}') == parseInt(sub_cat.id)) {
                        $("#sub_category").append('<option value="'+sub_cat.id+'" selected>'+sub_cat.name+'</option>');
                    }else {
                        $("#sub_category").append('<option value="'+sub_cat.id+'" >'+sub_cat.name+'</option>');
                    }
                });
              }else {
                $("#sub_category").append('<option value="" >Not found.</option>');
              }
                  
            },
            error: function(response) {
              document.getElementById('loading').style.display = 'none';
              swal('', response, 'error');
            },
            complete: function() {
              document.getElementById('loading').style.display = 'none';
            }
          });
      }

      function getSubCategoriesByArray(cat_id = null) {
          var cat_ids = $('#category').val() ? $('#category').val() : cat_id;
          $("#sub_category").html('');
          $.ajax({
              url:"{{url('sub/categories')}}",
              type: "POST",
              dataType : 'json',
              data: {
                '_token':'{{ csrf_token() }}',
                'ids'   : cat_ids
              },
              beforeSend: function() {
              document.getElementById('loading').style.display = 'block';
          },
          success: function(result) {
              if(result.data.length > 0) {
                $.each(result.data,function(key,sub_cat){
                    if(parseInt('{{ old('sub_cat') }}') == parseInt(sub_cat.id)) {
                        $("#sub_category").append('<option value="'+sub_cat.id+'" selected>'+sub_cat.name+'</option>');
                    }else {
                        $("#sub_category").append('<option value="'+sub_cat.id+'" >'+sub_cat.name+'</option>');
                    }
                });
              }else {
                $("#sub_category").append('<option value="" >Not found.</option>');
              }
                  getFoodItems();
            },
            error: function(response) {
              document.getElementById('loading').style.display = 'none';
              swal('', response, 'error');
            },
            complete: function() {
              document.getElementById('loading').style.display = 'none';
            }
          });
      }

      function getFoodItems(categories = null, sub_categories = null) {
          var categories = $('#category').val() ? $('#category').val() : categories;
          var sub_categories = $('#sub_category').val() ? $('#sub_category').val() : sub_categories;
          // console.log(categories);
          // console.log(sub_categories);
          $("#food_items").html('');
          $.ajax({
              url:"{{url('food/items')}}",
              type: "POST",
              dataType : 'json',
              data: {
                '_token':'{{ csrf_token() }}',
                'categories'   : categories,
                'sub_categories'   : sub_categories,
              },
              beforeSend: function() {
              document.getElementById('loading').style.display = 'block';
          },
          success: function(result) {
              if(result.data.length > 0) {
                $.each(result.data,function(key,sub_cat){
                    if(parseInt('{{ old('sub_cat') }}') == parseInt(sub_cat.id)) {
                        $("#food_items").append('<option value="'+sub_cat.id+'" selected>'+sub_cat.name+'</option>');
                    }else {
                        $("#food_items").append('<option value="'+sub_cat.id+'" >'+sub_cat.name+'</option>');
                    }
                });
              }else {
                $("#food_items").append('<option value="" >Not found.</option>');
              }
                  
            },
            error: function(response) {
              document.getElementById('loading').style.display = 'none';
              swal('', response, 'error');
            },
            complete: function() {
              document.getElementById('loading').style.display = 'none';
            }
          });
      }
</script>
<script>
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});

$(".varient_type_model").on("change", function() {
  alert();
});

$(document).ready(function() {
    $('#testimonial').owlCarousel({
      loop: true,
      margin: 10,
      responsiveClass: true,
      nav: false,
      dot: false,
      responsive: {
        0: {
          items: 1
        },
        600: {
          items: 1
        },
        1000: {
          items: 1
        }
      }
    })
  });

  $(document).ready(function() {
    $('#foodphotos').owlCarousel({
      loop: true,
      margin: 0,
      responsiveClass: true,
      nav: true,
      navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
      dot: false,
      responsive: {
        0: {
          items: 1
        },
        600: {
          items: 1
        },
        1000: {
          items: 1
        }
      }
    })
  });
</script>
</body>

</html>