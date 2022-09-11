<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

use App\Models\Exams as exam;
class Exams extends Component
{
    use WithPagination;
    use WithFileUploads;
    use LivewireAlert;
    protected $paginationTheme = 'bootstrap';

    public $name = "",$img , $exam_id,$del_name;

    protected $rules=[
        'name'=>'required',
        'img'=>'nullable|image'
    ];

    public function del(exam $exam){
        $this->exam_id = $exam->id;
        $this->del_name = $exam->name;

    }
    public function destory(){
        $exam = exam::find($this->exam_id);
        $exam->delete();
    }
    public function submit(){
        $this->validate();

        if($this->exam_id){
            $exam = exam::where('id',$this->exam_id)->first();
            $exam->name = $this->name;

            $exam->img = $this->img->store('public/uploads/images');
            $exam->save();
        }else{
            $exam = new exam();
            $exam->name = $this->name;
            if($this->img){
                $exam->img = $this->img->store('public/uploads/images');
            }
            
            $exam->save();
        }

        $this->dispatchBrowserEvent('modalClose');
        $this->alert('success', 'تم اضافه الأختبار بنجاح');
        $this->resetValidation();
        $this->reset();
        
        $this->img = null;
        
    }
    public function edit(exam $exam){
        $this->reset();
        $this->exam_id = $exam->id;
        $this->name = $exam->name;
        $this->img = $exam->img;
    }
    public function create()
    {
        $this->resetValidation();
        $this->reset();
        $this->img = null;
    }
    public function render()
    {
        $data = exam::latest()->paginate(12);

        return view('livewire.exams',compact('data'))->extends('layouts.admin')->section('content');
    }
}
