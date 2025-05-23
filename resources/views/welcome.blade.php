{{-- @php
    if(Auth::check()){
        $user = Auth::user();
        if($user->role == 'admin'){
            return redirect()->route('admin.dashboard');
        } elseif($user->role == 'user') {
            return redirect()->route('user.dashboard');
        }
    }else{
        return view('Admin.login');
    }
@endphp --}}