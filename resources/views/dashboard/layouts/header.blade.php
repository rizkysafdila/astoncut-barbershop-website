<div class="dropdown">
  <a class="link-dark text-decoration-none shadow" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
    <img class="rounded-3" src="{{ asset('img/rizky.png') }}" alt="{{ auth()->user()->name }}" width="36px" height="36px">
  </a>

  <ul class="dropdown-menu p-2 mt-3" aria-labelledby="dropdownMenuLink">
    <li>
      <form action="/logout" method="post">
        @csrf
        <button type="submit" class="dropdown-item">
          <i class="fa-duotone fa-arrow-right-from-bracket me-2"></i>
          Logout
        </button>
      </form>
    </li>
  </ul>
</div>
