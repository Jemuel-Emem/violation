<?php

namespace App\Livewire\Admin;
use App\Models\Violation as violationModel;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
class Statistics extends Component
{
    public $violationsData;
    public function render()
    {

        return view('livewire.admin.statistics',  [
            'violationsData' => ViolationModel::select('violation', DB::raw('count(*) as total'))
                ->groupBy('violation')
                ->get()
                ->toArray(),
        ]);

    }
    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {

        $this->violationsData = ViolationModel::select('violation', DB::raw('count(*) as total'))
        ->groupBy('violation')
        ->get();

    //dd($this->violationsData);
    }


}
