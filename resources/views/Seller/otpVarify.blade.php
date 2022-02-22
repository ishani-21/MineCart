<html>
   <title>Register Form</title>
   <head>

   </head>
   <body>


<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('saller-assets/app-assets/css/register.css') }}">


<div class="to-animate">
   <div id="form">
      <div class="container">
         <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-md-8 col-md-offset-2">
            <div id="userform">
               <ul class="nav nav-tabs nav-justified" role="tablist">
               </ul>
               <div class="tab-content">
                  <div class="tab-pane fade active in" id="signup">
                     <h2 class="text-uppercase text-center">Varify Email</h2>
                     <form method="post" id="signup" action="">
                        @csrf
                        <div class="row">
                           <div class="col-xs-12 col-sm-6">
                              <div class="form-group">
                                 <label>First Name<span class="req">*</span> </label>
                                 <input type="text" class="form-control" id="first_name" data-validation-required-message="Please enter your name." autocomplete="off">
                                 <p class="help-block text-danger"></p>
                              </div>
                           </div>
                           <div class="col-xs-12 col-sm-6">
                              <div class="form-group">
                                 <label> Last Name<span class="req">*</span> </label>
                                 <input type="text" class="form-control" id="last_name" data-validation-required-message="Please enter your name." autocomplete="off">
                                 <p class="help-block text-danger"></p>
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <label> Your Email<span class="req">*</span> </label>
                           <input type="email" class="form-control" id="email" data-validation-required-message="Please enter your email address." autocomplete="off">
                           <p class="help-block text-danger"></p>
                        </div>
                        <div class="form-group">
                           <label> Your Phone<span class="req">*</span> </label>
                           <input type="tel" class="form-control" id="phone" data-validation-required-message="Please enter your phone number." autocomplete="off">
                           <p class="help-block text-danger"></p>
                        </div>
                        <div class="form-group">
                           <label> Password<span class="req">*</span> </label>
                           <input type="password" class="form-control" id="password" data-validation-required-message="Please enter your password" autocomplete="off">
                           <p class="help-block text-danger"></p>
                        </div>
                        <div class="mrgn-30-top">
                           <button type="submit" class="btn btn-larger btn-block" id="sign">
                           Sign up
                           </button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- /.container -->
</div>
</body>

<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script>
   $('#form').find('input, textarea').on('keyup blur focus', function(e) {

      var $this = $(this),
         label = $this.prev('label');

      if (e.type === 'keyup') {
         if ($this.val() === '') {
            label.removeClass('active highlight');
         } else {
            label.addClass('active highlight');
         }
      } else if (e.type === 'blur') {
         if ($this.val() === '') {
            label.removeClass('active highlight');
         } else {
            label.removeClass('highlight');
         }
      } else if (e.type === 'focus') {

         if ($this.val() === '') {
            label.removeClass('highlight');
         } else if ($this.val() !== '') {
            label.addClass('highlight');
         }
      }

   });

   $('.tab a').on('click', function(e) {

      e.preventDefault();

      $(this).parent().addClass('active');
      $(this).parent().siblings().removeClass('active');

      target = $(this).attr('href');

      $('.tab-content > div').not(target).hide();

      $(target).fadeIn(800);

   });


   $('select').change(function() {
      var animtype = $('select').val();

      $('.to-animate').addClass('animated ' + animtype);
      $('.to-animate').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',
         function() {
            $('.to-animate').removeClass('animated ' + animtype);
         });
   });
</script>
</html>
