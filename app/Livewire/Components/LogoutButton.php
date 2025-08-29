<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class LogoutButton extends Component
{

  public function logout(): void
  {
    Auth::guard('web')->logout();

    Session::invalidate();
    Session::regenerateToken();
    $this->redirect('/', navigate: true);
  }


  public function render()
  {
    return view('livewire.components.logout-button');
  }
}
