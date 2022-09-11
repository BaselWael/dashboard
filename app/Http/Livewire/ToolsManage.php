<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Exams;
use App\Models\tools as Tool;
use App\Models\toolsContent;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
class ToolsManage extends Component
{
    use WithPagination;
    use WithFileUploads;
    use LivewireAlert;

    public $tool ,$del_name   ,$i =0 , $answers_added,$answers_edit ,$answers =[]  ,$tools_id;
    protected $rules =[
        'tool'=>'required',
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

    public function submit(){
        $this->validate();
        if($this->tools_id) #editing
        {
            $tool = Tool::where('id',$this->tools_id)->first();
            $tool->name = $this->tool;
            $tool->save();
            foreach ($this->answers_added as $key=>$value) {
                $answers = toolsContent::where(['tools_id'=>$this->tools_id , 'value'=>$this->answers_edit[$key]])->first();
                $answers->value = $this->answers_added[$key];
                $answers->save();
            }
            $this->alert('success', 'تم التعدل بنجاح');
        }else{
            // dd([$this->answers_added , $this->checks]);
            $tool = new Tool();
            $tool->name = $this->tool;
            $tool->save();
    
            foreach ($this->answers_added as $key => $value) {
                
                $answer = new toolsContent();
                $answer->tools_id = $tool->id;
                $answer->value = $value;
                $answer->save();
            }

        $this->alert('success', 'تم اضافه السؤال بنجاح');
   
        }
        $this->dispatchBrowserEvent('modalClose');

  
        $this->resetValidation();
        $this->reset();

        
    }
    public function destory(){
        $ques = Tool::where('id',$this->tools_id)->first();
        $ques->delete();
        $this->reset();
        $this->alert('success', 'تم حذف السؤال بنجاح');

    }
    public function del(Tool $question){
        $this->reset();

        $this->question_id = $question->id;
        $this->del_name = $question->question;
    }
    public function create(){
        $this->resetValidation();
        $this->reset();
    }
    public function edit(Tool $tool){
        $this->resetValidation();
        $this->reset();
        $this->tools_id = $tool->id;
        $this->tool = $tool->name;
        foreach ($tool->content as $key => $value) {
            array_push($this->answers, $key);

            $this->answers_added[$key] = $value->value;
            $this->answers_edit[$key] = $value->value;

        }
    }
    public function render()
    {
        $data = Tool::latest()->paginate(10);
        return view('livewire.tools-manage',compact('data'))->extends('layouts.admin')->section('content');
    }
}
