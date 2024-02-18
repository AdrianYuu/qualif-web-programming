<nav class="navbar navbar-expand-lg">
    <div class="container-fluid px-3 py-2">
        <a class="navbar-brand ml-5" href="{{ route('home') }}"><img src="{{ asset('assets/TokopediaLogo.png') }}" alt="logo" width="180" height="40"></a>
        <div class="collapse navbar-collapse d-flex gap-4" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @if(Auth::user()->role->name == "admin")
                    <li class="nav-item dropdown">
                        <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Admin Action
                        </a>
                        <ul class="dropdown-menu ps-2">
                            <li>
                                <a class="nav-link active" href="{{ route('item_create') }}">Create Item</a>
                            </li>
                            <li>
                                <a class="nav-link active" href="{{ route('category') }}">Category List</a>
                            </li>
                            <li>
                                <a class="nav-link active" href="{{ route('invoice') }}">Invoice List</a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
            @if(Auth::user()->role->name == "member")
                <a href="{{ route('cart', ['user_id' => Auth::user()->user_id]) }}">
                    <img src="{{ asset('assets/Cart.png') }}" alt="cart" style="width: 30px; height: 25px;">
                </a>
            @endif
            <a href="{{ route('profile', ['user_id' => Auth::user()->user_id]) }}">
                <img src="{{ asset('assets/Profile.png') }}" alt="profile" width="60" height="60">
            </a>
        </div>
    </div>
</nav>

<hr class="border border-success border-1 opacity-50 mt-0">