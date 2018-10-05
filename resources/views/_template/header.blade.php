<nav class="navbar navbar-expand-lg navbar-light">
  <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ url('/') }}/images/logo.png"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    @if(Auth::user())
      <ul class="navbar-nav ml-auto">
          @if(Auth::user()->role == "Admin") 
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-users-cog"> </i> Manage Accounts
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ url('/') }}/manage-account"><i class="fa fa-users"></i> List of Accounts</a>
                <a class="dropdown-item" href="{{ url('/') }}/manage-account/add"><i class="fa fa-user-plus"></i> Add Account</a>
              </div>
            </li>
          @endif
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-file-alt"></i> Report
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ url('/') }}/report/generate"><i class="fa fa-print"></i> Generate Report</a>
            @if(Auth::user()->role == "Admin") 
                <a class="dropdown-item" href="{{ url('/') }}/report/audit"><i class="fa fa-flag"></i> Audit Trail</a>
            @endif
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-user-circle"></i> Account
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ url('/') }}/account/{{ Auth::user()->id }}"><i class="fa fa-user"></i> My Account</a>
            <a class="dropdown-item" href="{{ url('/') }}/account/{{ Auth::user()->id }}/change-password"><i class="fa fa-lock-open"></i> Change Password</a>
            <a class="dropdown-item" href="{{ url('/') }}/account/logout"><i class="fa fa-sign-out-alt"></i> Logout</a>
          </div>
        </li>
      </ul>
    @endif
  </div>
</nav>