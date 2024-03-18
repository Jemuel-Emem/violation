<?php

namespace App\Livewire\Admin;
use App\Models\User as userModel;
use Livewire\Component;
use Livewire\WithPagination;
class Addusers extends Component
{
    use  WithPagination;
    public $name, $email, $password,$is_admin, $search;
    public $add_modal = false;
    public function render()
    {


        $search = '%' .$this->search. '%';
        return view('livewire.admin.addusers',[
            'user' => userModel::where('name', 'like', $search)->paginate(10),
        ]);
    }

    public function submit()
    {
        sleep(2);

        // $this->validate([
        //     'name' => 'required',
        //     'email' => 'required',
        //     'password' => 'required',
        //     'is_admin' => 'required',




        // ]);

       userModel::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'is_admin' => $this->is_admin,
        ]);


        $this->add_modal = false;
        $this->reset([
            'name', 'email', 'password', 'is_admin'
        ]);
    }

    public function asss()
    {

        $this->resetPage();


    }

    public function back(){
        $this->reset([
            'name', 'email', 'password'
        ]);
    }
}
