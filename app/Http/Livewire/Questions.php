<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Exams;
use App\Models\questions as Ques;
use App\Models\answers;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Questions extends Component
{
    use WithPagination;
    use WithFileUploads;
    use LivewireAlert;

    public $exam_id , $question , $q_choices , $q_img,$del_name   , $choices=[] , $i =0 , $answers_added,$answers_edit ,$answers =[] ,$checks=[] ,$question_id;
    protected $rules =[
        'question'=>'required',
        'exam_id'=>'required',
        'answers_added.*' => 'required'
    ];
    public function addChoices($i){
        
        $this->validate([
            'answers_added.*' => 'required',
        ]);
        $i++;
        $this->i = $i;
        array_push($this->answers, $this->i);
        $this->answers_added[$i] = "?";

        
    }
    public function closecheck($key){
        foreach ($this->answers as $key2 => $value) {
            if($key2 != $key){
                
                $this->checks[$key2] = false;

            }
        }
    }
    public function choices(){
        $this->q_img = false;
    }
    public function imgg(){
        $this->q_choices = false;
        // $this->q_img=true;
    }
    public function submit(){
        $this->validate();
        if($this->question_id) #editing
        {
            $question = Ques::where('id',$this->question_id)->first();
            $question->question = $this->question;
            $question->exam_id = $this->exam_id;
            $question->save();
            foreach ($this->answers_added as $key=>$value) {
                $answers = answers::where(['questions_id'=>$this->question_id , 'answer'=>$this->answers_edit[$key]])->first();
                $answers->answer = $this->answers_added[$key];
                $answers->save();
            }
            $this->alert('success', 'تم التعدل بنجاح');
        }else{
            $question = new Ques();
            $question->exam_id = $this->exam_id;
            $question->question = $this->question;
            if($this->q_choices){
                $question->type = "choices";
            }else{
                $question->type = "img";
            }
            $question->save();
    
            foreach ($this->answers_added as $key => $value) {
                $answer = new answers();
                $answer->questions_id = $question->id;
                $answer->answer = $value;
                $answer->save();
        }
        $this->alert('success', 'تم اضافه السؤال بنجاح');
   
        }
        $this->dispatchBrowserEvent('modalClose');

  
        $this->resetValidation();
        $this->reset();

        
    }
    public function destory(){
        $ques = Ques::where('id',$this->question_id)->first();
        $ques->delete();
        $this->reset();
        $this->alert('success', 'تم حذف السؤال بنجاح');

    }
    public function del(Ques $question){
        $this->reset();

        $this->question_id = $question->id;
        $this->del_name = $question->question;
    }
    public function create(){
        $this->resetValidation();
        $this->reset();
    }
    public function edit(Ques $question){
        $this->resetValidation();
        $this->reset();
        $this->question_id = $question->id;
        $this->exam_id = $question->exam_id;
        $this->question = $question->question;
        if($question->type == "choices"){
            $this->q_choices = true;
        }else{
            $this->q_img = true;
        }
        foreach ($question->answer as $key => $value) {
            array_push($this->answers, $key);
            $this->answers_added[$key] = $value->answer;
            $this->answers_edit[$key] = $value->answer;

        }
    }
    public function render()
    {
        $exams = Exams::get();
        $data = Ques::latest()->paginate(10);
        return view('livewire.questions',compact('exams','data'))->extends('layouts.admin')->section('content');
    }
}
