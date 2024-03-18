<?php

namespace App\Livewire\Admin;
use App\Models\studentlist as studentModel;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
class Studentlist extends Component
{
    //m
    use WithFileUploads, WithPagination;
    public $add_modal = false;
    public $edit_modal = false;
    public $search;
    public $lrn,$firstname,$middlename,$lastname,$age, $sex,$address,$contactnumber, $grade,$strand_course,$section, $student_id;
    public function render()
    {

        $search = '%' .$this->search. '%';
        return view('livewire.admin.studentlist',[
            'student' => studentModel::where('firstname', 'like', $search)->paginate(10),
        ]);

    }
    public function asss()
    {


        $this->resetPage();


    }
    public function submit()
    {
        sleep(2);
        $this->validate([
            'lrn' => 'required',
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'age' => 'required',
            'sex' => 'required',
            'address' => 'required',
            'contactnumber' => 'required',
            'grade' => 'required',
            'strand_course' => 'required',
            'section' => 'required',

        ]);

        studentModel::create([
            'lrn' => $this->lrn,
            'firstname' => $this->firstname,
            'middlename' => $this->middlename,
            'lastname' => $this->lastname,
            'age' => $this->age,
            'sex' => $this->sex,
            'address' => $this->address,
            'contactnumber' => $this->contactnumber,
            'grade' => $this->grade,
            'strand_course' => $this->strand_course,
            'section' => $this->section,
        ]);

        $this->add_modal = false;
        $this->reset([
            'lrn','sex','firstname', 'middlename', 'lastname', 'age', 'address', 'contactnumber', 'grade', 'strand_course', 'section'
        ]);
    }

      public function edit($valueId)
    {
        $data = studentModel::where('id', $valueId)->first();
        $this->lrn = $data->lrn;
        $this->firstname = $data->firstname;
        $this->middlename = $data->middlename;
        $this->lastname = $data->lastname;
        $this->age = $data->age;
        $this->sex = $data->sex;
        $this->address = $data->address;
        $this->contactnumber = $data->contactnumber;
        $this->grade = $data->grade;
        $this->strand_course = $data->strand_course;
        $this->section = $data->section;
        $this->student_id = $data->id;
        $this->edit_modal = true;

    }

    public function submitEdit()
    {
        $data = studentModel::where('id', $this->student_id)->first();

        $data->update([
            'lrn' => $this->lrn,
            'firstname' => $this->firstname,
            'middlename' => $this->middlename,
            'lastname' => $this->lastname,
            'age' => $this->age,
            'sex' => $this->sex,
            'address' => $this->address,
            'contactnumber' => $this->contactnumber,
            'grade' => $this->grade,
            'strand_course' => $this->strand_course,
            'section' => $this->section,

        ]);

        $this->edit_modal = false;
        $this->reset([
           'lrn','firstname', 'middlename', 'lastname', 'age','sex', 'address', 'contactnumber', 'grade', 'strand_course', 'section'
        ]);
    }

    public function delete($id){
        sleep(1);
        $data = studentModel::find($id);
        $data->delete();
        $this->render();
    }
    public function back(){
        $this->reset([
            'lrn','firstname', 'middlename', 'lastname', 'age','sex', 'address', 'contactnumber', 'grade', 'strand_course', 'section'
        ]);
    }
}
