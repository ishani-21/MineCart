<nav class="navbar navbar-expand-lg navbar-light header-navbar navbar-fixed">
   <div class="container-fluid navbar-wrapper">
      <div class="navbar-header d-flex">
         <div class="navbar-toggle menu-toggle d-xl-none d-block float-left align-items-center justify-content-center" data-toggle="collapse"><i class="ft-menu font-medium-3"></i></div>
         <ul class="navbar-nav">
            <li class="nav-item mr-2 d-none d-lg-block"><a class="nav-link apptogglefullscreen" id="navbar-fullscreen" href="javascript:;"><i class="ft-maximize font-medium-3"></i></a></li>
            <!-- <li class="nav-item nav-search"><a class="nav-link nav-link-search" href="javascript:">
                    <i class="ft-search font-medium-3"></i></a>
                    <div class="search-input">
                        <div class="search-input-icon"><i class="ft-search font-medium-3"></i></div>
                        <input class="input" type="text" placeholder="Explore Apex..." tabindex="0"
                            data-search="template-search">
                        <div class="search-input-close"><i class="ft-x font-medium-3"></i></div>
                        <ul class="search-list"></ul>
                    </div>
                </li> -->
         </ul>
      </div>
      <div class="navbar-container">
         <div class="collapse navbar-collapse d-block" id="navbarSupportedContent">
            <ul class="navbar-nav">
               <div class="col-md-6 col-12">
                  <fieldset class="form-group">
                     <?php
                     $store = App\Models\Store::where('saller_id', Illuminate\Support\Facades\Auth::user()->id)->get();
                     ?>
                     <?php
                     $a = App\Models\Store::where('saller_id', Illuminate\Support\Facades\Auth::user()->id)->first();
                     ?>
                     @if($a['is_approve'] == 1)
                     @if (count($store) >= 1)
                     <select class="custom-select store filter-name qual_id" id="store" name="store">
                        @foreach ($store as $store)
                        <?php
                        $approve = App\Models\Store::where('id', $store->id)->where('is_approve', '1')->get();
                        ?>
                        @foreach($approve as $approve)
                        <option value="{{ $approve->id }}" @if (Session::get('name')==$approve->id)selected @endif>
                           {{ $approve->en_name }}
                        </option>
                        @endforeach
                        @endforeach
                     </select>
                     @else
                     <option>Plaase create store</option>
                     @endif
                     @elseif($a['is_approve'] == 2)
                     <option>Your Store Rejected</option>
                     @else
                     <option>Your Store pandding</option>
                     @endif
                  </fieldset>
               </div>
               <li class="dropdown nav-item">
                  <a class="nav-link dropdown-toggle dropdown-notification p-0 mt-2 notifi" id="dropdownBasic1" href="javascript:;" data-toggle="dropdown">
                     <i class="ft-bell font-medium-3"></i>
                     <span class="notification badge badge-pill badge-danger" id="count">
                        <!-- count notification -->
                     </span>
                  </a>
                  <ul class="notification-dropdown dropdown-menu dropdown-menu-media dropdown-menu-right m-0 overflow-hidden">
                     <li class="dropdown-menu-header">
                        <div class="dropdown-header d-flex justify-content-between m-0 px-3 py-2 white bg-primary">
                           <div class="d-flex"><i class="ft-bell font-medium-3 d-flex align-items-center mr-2"></i><span class="noti-title" id="count"> New Notification</span></div>
                           <!-- <span class="text-bold-400 cursor-pointer">Mark all as read</span> -->
                        </div>
                     </li>
                     <li class="scrollable-container"><a class="d-flex justify-content-between" href="javascript:void(0)">
                           <div class="media d-flex align-items-center">
                              <!-- <div class="media-left">
                                 <div class="mr-3"><img class="avatar" src="{{ asset('saller-assets/app-assets/img/portrait/small/pic-8.png') }}" alt="avatar" height="45" width="45"></div>
                              </div> -->
                              <div class="media-body appends" id="appends">
                                 <!-- message -->
                              </div>
                           </div>
                        </a>

                     </li>
                     <li class="dropdown-menu-footer">
                        <div class="noti-footer text-center cursor-pointer primary border-top text-bold-400 py-1">
                           <!-- Read All Notifications -->
                        </div>
                     </li>
                  </ul>
               </li>
               <li class="dropdown nav-item mr-1"><a class="nav-link dropdown-toggle user-dropdown d-flex align-items-end" id="dropdownBasic2" href="javascript:;" data-toggle="dropdown">
                     <div class="user d-md-flex d-none mr-2"><span class="text-right">@if (Auth::Guard('seller')->user()->fname) {{ Auth::Guard('seller')->user()->fname }} @else {{ Auth::Guard('seller')->user()->bussiness_name }} @endif </span><span class="text-right text-muted font-small-3">Available</span></div>
                     <img class="avatar" src="{{ asset('saller-assets/app-assets/img/portrait/small/default.png') }}" alt="avatar" height="35" width="35">
                  </a>
                  <div class="dropdown-menu text-left dropdown-menu-right m-0 pb-0" aria-labelledby="dropdownBasic2"><a class="dropdown-item" href="app-chat.html">
                        <!-- <div class="d-flex align-items-center"><i -->
                        <!-- class="ft-message-square mr-2"></i><span>Chat</span></div> -->
                     </a>
                     <a class="dropdown-item" href="{{ route('seller.show_edit_profile') }}">
                        <div class="d-flex align-items-center"><i class="ft-edit mr-2"></i><span>Edit
                              Profile</span></div>
                     </a>
                     <a class="dropdown-item" href="{{ route('seller.changePasswordGet') }}">
                        <div class="d-flex align-items-center"><i class="ft-mail mr-2"></i><span>Change
                              Password</span></div>
                     </a>
                     <div class="dropdown-divider"></div><a class="dropdown-item" href="auth-login.html" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <div class="d-flex align-items-center"><i class="ft-power mr-2"></i><span>Logout</span>
                        </div>
                     </a>
                  </div>
               </li>
                  <form id="logout-form" action="{{ route('seller.logout') }}" method="POST" class="d-none">
                     @csrf
                  </form>
               {{-- <li class="nav-item d-none d-lg-block mr-2 mt-1"><a class="nav-link notification-sidebar-toggle" href="javascript:;"><i class="ft-align-right font-medium-3"></i></a></li> --}}
            </ul>
         </div>
      </div>
   </div>
</nav>

<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script>
   $(document).ready(function() {
      $.ajax({
         url: "{{ route('seller.count_notification') }}",
         type: 'get',
         dataType: "json",
         success: function(data) {
            $("#count").html(data);
         }
      })
   });
   $('.notifi').on('click', function() {
      $.ajax({
         url: "{{ route('seller.show_notification') }}",
         type: 'get',
         dataType: "json",
         success: function(data) {
            var html = "";
            for (var i = 0; i < data.length; i++) {
               console.log(data.length);
               $('#count').val(data.length);
               html += '<h6 class="m-0"><span> ' + data[i].title +
                  ' </span><button style="float:right" type="button" data-id=' + data[i].id +
                  ' class="btn-close add"></button></h6><h6 class="noti-text font-small-3 m-0">' +
                  data[i].message + '</h6></br>';
            }
            $("#appends").html(html);
         }
      })
   });

   $(document).on('click', '.add', function() {
      var delet = $(this).data('id');
      var url = "{{ route('seller.delete_noti', ':queryId') }}";
      url = url.replace(':queryId', delet);
      $.ajax({
         url: url,
         type: "POST",
         data: {
            id: delet,
            _token: '{{ csrf_token() }}'
         },
         dataType: "json",
         success: function(data) {
            $("#count").html(data.counter);
         }
      });
   });
</script>
