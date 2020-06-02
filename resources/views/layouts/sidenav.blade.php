  @guest
  @else
  <nav class="border-left border-right" id="sidebar">
    
    <div class="dropdown-divider"></div>
    <ul class="list-unstyled">
      <li class="active">
        &nbsp;&nbsp;<a href="#homeSubmenu" data-toggle="collapse" aria-expended="false" class="dropdown-toggle text-info"><i class="fas fa-mail-bulk"></i>&nbsp;Letters</a>
          <ul class="show menu" id="homeSubmenu" style="list-style-type: none;">
                <li><a href="/receive" class="text-secondary"><i class="fas fa-envelope-open-text"></i>&nbsp;Receive</a></li>
                <li><a href="{{ route('create.create')}}" class="text-secondary"><i class="far fa-envelope"></i>&nbsp;Dispatch</a></li>
                <li><a href="{{ route('notify.create')}}" class="text-secondary"><i class="fas fa-bell"></i>&nbsp;Notify</a></li>
                <li><a href="/showletters" class="text-secondary"><i class="fas fa-star"></i>&nbsp;Important</a> &nbsp; </li>
                <!-- <li><a href="/showletters" class="text-secondary"><i class="fas fa-star"></i>&nbsp;Important</a> &nbsp; <span class="badge badge-primary badge-pill">14</span>&nbsp;</li> -->
                <li><a href="/incoming" class="text-secondary"><i class="fas fa-inbox"></i>&nbsp;Inbox</a>&nbsp; </li>
                <li><a href="/copyletters" class="text-secondary"><i class="fas fa-info-circle"></i>&nbsp;Copy(Cc)</a>&nbsp;</li>
                <!-- <li><a href="#" class="text-secondary"><i class="far fa-file-alt"></i>&nbsp;Draft</a>&nbsp;<span class="badge badge-primary badge-pill">3</span></li>
                <li><a href="#" class="text-secondary"><i class="fas fa-pause"></i>&nbsp;Pending</a>&nbsp;<span class="badge badge-primary badge-pill">1</span></li> -->
                <li><a href="/markedlist" class="text-secondary"><i class="fas fa-forward"></i>&nbsp;Marked To</a></li> 
                <li><a href="{{ route('marked.index')}}" class="text-secondary"><i class="far fa-paper-plane"></i>&nbsp;Marked</a></li>
                <!-- <li><a href="#" class="text-secondary"><i class="far fa-trash-alt"></i>&nbsp;Trash</a></li> -->
               
          </ul>
        </li>
        <div class="dropdown-divider"></div>
        <li>
        &nbsp;&nbsp;<a href="#information" data-toggle="collapse" aria-expended="false" class="dropdown-toggle text-info"><i class="fas fa-info"></i>&nbsp;Information</a>
          <ul class="collapse menu" id="information" style="list-style-type: none;">
                <li><a href="{{ route('notify.index') }}" class="text-secondary"><i class="fas fa-bell-slash"></i>&nbsp;Notification</a></li>
                <li><a href="/contactlist" class="text-secondary"><i class="fas fa-phone-square-alt"></i>&nbsp;Contact List</a></li>
               <!-- <li><a href="#" class="text-secondary"><i class="fas fa-sticky-note"></i>&nbsp;Guidelines</a></li> -->
               <!-- <li><a href="#" class="text-secondary"><i class="fas fa-phone-square-alt"></i>&nbsp;....</a></li> -->
          </ul>
        </li>

        <div class="dropdown-divider"></div>
        <li>
        &nbsp;&nbsp;<a href="#settingMenu" data-toggle="collapse" aria-expended="false" class="dropdown-toggle text-info"><i class="fas fa-cogs"></i>&nbsp;Setting</a>
          <ul class="collapse menu" id="settingMenu" style="list-style-type: none;">
                <li><a href="{{ route('profile.index') }}" class="text-secondary"><i class="far fa-id-card"></i>&nbsp;Profile</a></li>
                <!-- <li><a href="#" class="text-secondary"><i class="far fa-user"></i>&nbsp;Officiating</a></li> -->
                <li><a href="/changepassword" class="text-secondary"><i class="fas fa-key"></i>&nbsp;Password change&nbsp;</a></li>
                <!-- <li><a href="#" class="text-secondary"><i class="fas fa-users"></i>&nbsp;Group</a></li> -->
                <li><a href="{{ route('reference.create') }}" class="text-secondary"><i class="fas fa-id-card"></i>&nbsp;Letter Reference</a></li>
          </ul>
        </li>
      </ul>
  </nav>

  @endguest

