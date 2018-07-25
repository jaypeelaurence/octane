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
                Manage Accounts
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ url('/') }}/manage-account">List of Accounts</a>
                <a class="dropdown-item" href="{{ url('/') }}/manage-account/add">Add Account</a>
              </div>
            </li>
          @endif
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/') }}/report">Report</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Account
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ url('/') }}/account/{{ Auth::user()->id }}">My Account</a>
            <a class="dropdown-item" href="{{ url('/') }}/account/{{ Auth::user()->id }}/change-password">Change Password</a>
            <a class="dropdown-item" href="{{ url('/') }}/account/logout">Logout</a>
          </div>
        </li>
      </ul>
    @endif
  </div>
</nav>