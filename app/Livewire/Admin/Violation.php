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
    public $lrn,$firstname,$middlename,$lastname, $sex,$grade,$strand,$section,$sanction, $violation,$offence,$date_and_time,$photo, $violation_id;
    public $search;
    public $strand_course;
    public $students = [];
    public function render()
    {

        $search = '%' .$this->search. '%';
        return view('livewire.admin.violation',[
            'violations' => violationModel::where('lrn', 'like', $search)->paginate(10),
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
            'firstname' => 'required',
            'strand' => 'required',
            'violation' => 'required',
            'grade' => 'required',
            'section' => 'required',
            'sanction' => 'required',
            'offence' => 'required',
            'date_and_time' => 'required',


        ]);

        violationModel::create([
            'lrn' =>$this->lrn,
            'firstname' => $this->firstname,
            'middlename' => $this->middlename,
            'lastname' => $this->lastname,
            'sex' => $this->sex,
            'strand' => $this->strand,
            'violation' => $this->violation,
            'grade' => $this->grade,
            'section' => $this->section,
            'sanction' => $this->sanction,
            'offence' => $this->offence,
            'date_and_time' => $this->date_and_time,


        ]);

        $this->add_modal = false;
        $this->reset([
            'firstname','lastname','middlename','sex', 'strand', 'violation', 'grade', 'section', 'sanction', 'offence', 'date_and_time', 'photo', 'violation_id'
        ]);
    }

    public function edit($valueId)
    {
        $data = violationModel::where('id', $valueId)->first();

    if ($data) {
        $this->lrn = $data->lrn;
        $this->firstname = $data->firstname;
        $this->middlename = $data->middlename;
        $this->lastname = $data->lastname;
        $this->sex = $data->sex;
        $this->grade = $data->grade;
        $this->strand = $data->strand;
        $this->section = $data->section;
        $this->violation = $data->violation;
        $this->sanction = $data->sanction;
        $this->offence = $data->offence;
        $this->date_and_time = $data->date_and_time;
        $this->violation_id = $data->id;
        $this->edit_modal = true;
    } else {

    }
    }

    public function submitEdit()
    {
        $data = violationModel::where('id', $this->violation_id)->first();

        $data->update([
            'lrn' => $this->lrn,
            'firstname' => $this->firstname,
            'middlename' => $this->middlename,
            'lastname' => $this->lastname,
            'sex' => $this->sex,
            'strand' => $this->strand,
            'violation' => $this->violation,
            'grade' => $this->grade,
            'section' => $this->section,
            'offence' => $this->offence,
            'date_and_time' => $this->date_and_time,
        ]);


        if ($this->offence == 3) {
            $data->update(['sanction' => 'warning']);
        }

        if ($this->offence >= 4) {
            $data->update(['sanction' => 'penalty']);
        }

        else {
            $data->update(['sanction' => $this->sanction]);
        }



        $this->edit_modal = false;
        $this->reset([
            'lrn','firstname','middlename','lastname','sex', 'strand', 'violation', 'grade', 'section', 'sanction', 'offence', 'date_and_time', 'photo', 'violation_id'
        ]);
    }

    public function delete($id){
        sleep(1);
        $data = violationModel::find($id);

        $data->delete();
        $this->render();
    }
    public function back(){
        $this->reset([
            'lrn','firstname','middlename','lastname','sex', 'strand', 'violation', 'grade', 'section', 'sanction', 'offence', 'date_and_time', 'photo', 'violation_id'
        ]);
    }

    public function fillName($value,$firstname,$middlename,$lastname, $sex, $grade,$strand_course,  $section)
    {
        $this->lrn = $value;
        $this->firstname = $firstname;
        $this->middlename = $middlename;
        $this->lastname = $lastname;
        $this->sex = $sex;
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
