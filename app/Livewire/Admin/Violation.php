<?php

namespace App\Livewire\Admin;
use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Violation as violationModel;
use App\Models\studentlist as students;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Violation extends Component
{

    use WithFileUploads, WithPagination;
    public $add_modal = false;
    public $edit_modal = false;
    public $firstname,$grade,$strand,$section,$sanction, $violation,$offence,$date_and_time,$photo, $violation_id;
    public $search;
    public $strand_course;
    public $students = [];
    public function render()
    {

        $search = '%' .$this->search. '%';
        return view('livewire.admin.violation',[
            'violations' => violationModel::where('name', 'like', $search)->paginate(10),
        ]);


    }

 public function asss()
    {

        $this->resetPage();

        $violations = violationModel::where('firstname', 'like', '%' . $this->search . '%')
            ->orWhere('grade', 'like', '%' . $this->search . '%')
            ->orWhere('strand', 'like', '%' . $this->search . '%')
            ->orWhere('section', 'like', '%' . $this->search . '%')
            ->orWhere('violation', 'like', '%' . $this->search . '%')
            ->orWhere('sanction', 'like', '%' . $this->search . '%')
            ->orWhere('offence', 'like', '%' . $this->search . '%')
            ->orWhere('date_and_time', 'like', '%' . $this->search . '%')
            ->paginate(10);
    }

    public function submit()
    {
        sleep(2);
        $this->validate([
            'name' => 'required',
            'strand' => 'required',
            'violation' => 'required',
            'grade' => 'required',
            'section' => 'required',
            'sanction' => 'required',
            'offence' => 'required',
            'date_and_time' => 'required',
            'photo' => 'required|max:2048',

        ]);
        $photoPath = $this->photo->store('photos', 'public');
        violationModel::create([
            'name' => $this->name,
            'strand' => $this->strand,
            'violation' => $this->violation,
            'grade' => $this->grade,
            'section' => $this->section,
            'sanction' => $this->sanction,
            'offence' => $this->offence,
            'date_and_time' => $this->date_and_time,
            'photo' => $photoPath,

        ]);

        $this->add_modal = false;
        $this->reset([
            'name', 'strand', 'violation', 'grade', 'section', 'sanction', 'offence', 'date_and_time', 'photo', 'violation_id'
        ]);
    }

    public function edit($valueId)
    {
        $data = violationModel::where('id', $valueId)->first();

    if ($data) {
        $this->firstname = $data->name;
        $this->grade = $data->grade;
        $this->strand = $data->strand;
        $this->section = $data->section;
        $this->violation = $data->violation;
        $this->sanction = $data->sanction;
        $this->offence = $data->offence;
        $this->date_and_time = $data->date_and_time;

        // Check if $data->photo is an instance of Illuminate\Http\UploadedFile
        // If not, handle the photo logic accordingly (e.g., setting a file path or null)
        if ($data->photo instanceof \Illuminate\Http\UploadedFile) {
            $this->photo = $data->photo;
        }

        $this->violation_id = $data->id;
        $this->edit_modal = true;
    } else {

    }
    }

    public function submitEdit()
    {
        $data = violationModel::where('id', $this->violation_id)->first();

        $data->update([
            'name' => $this->name,
            'strand' => $this->strand,
            'violation' => $this->violation,
            'grade' => $this->grade,
            'section' => $this->section,
            'offence' => $this->offence,
            'date_and_time' => $this->date_and_time,
        ]);


        if ($this->offence == 3) {
            $data->update(['sanction' => 'warning']);
        } else {
            $data->update(['sanction' => $this->sanction]);
        }

        if ($this->photo instanceof \Illuminate\Http\UploadedFile) {
            Storage::disk('public')->delete($data->photo);
            $updateData['photo'] = $this->photo->store('photos', 'public');
            $data->update(['photo' => $updateData['photo']]);
        }

        $this->edit_modal = false;
        $this->reset([
            'name', 'strand', 'violation', 'grade', 'section', 'sanction', 'offence', 'date_and_time', 'photo', 'violation_id'
        ]);
    }

    public function delete($id){
        sleep(1);
        $data = violationModel::find($id);
        Storage::disk('public')->delete($data->photo);
        $data->delete();
        $this->render();
    }
    public function back(){
        $this->reset([
            'firstname', 'strand', 'violation', 'grade', 'section', 'sanction', 'offence', 'date_and_time', 'photo', 'violation_id'
        ]);
    }

    public function fillName($value, $grade,$strand_course,  $section)
    {
        $this->firstname = $value;
        $this->grade = $grade;
        $this->strand = $strand_course;
        $this->section = $section;


        $this->students = [];
    }
    public function searchStudents()
{
    $this->students = students::where('firstname', 'like', '%' . $this->firstname . '%')->take(5)->get();
}

}
