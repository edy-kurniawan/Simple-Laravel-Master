<?php

namespace App\Http\Livewire\Cms;

use Livewire\Component;
use App\Models\Category;

class CategoryLivewire extends Component
{
    public $counter = 1;
    public $categoryId, $name, $desc;

    protected $rules = [
        'name' => 'required|min:2',
    ];

    private function resetField(){
        $this->categoryId = "";
        $this->name = "";
        $this->desc = "";
    }
    
    public function render()
    {
        $data  = Category::all();
        return view('livewire.category',compact('data'));
    }

    public function store()
    {    
        $this->validate();

        // Execution doesn't reach here if validation fails.
        if($this->categoryId == ""){
            Category::create([
                'name' => $this->name,
                'desc' => $this->desc,
            ]);
        
            session()->flash('message', 'Category Created Successfully.');

        }else{
            $getCategory = Category::find($this->categoryId);
            $getCategory->update([
                'name'  => $this->name,
                'desc'  => $this->desc,
            ]);
            
            session()->flash('message', 'Category Created Successfully.');

        }
        
        $this->resetField();
        $this->emit('closeModal'); // Close model to using to jquery

    }

    public function edit($id)
    {
        $getCategory = Category::where('id',$id)->first();
        $this->categoryId    = $id;
        $this->name  = $getCategory->name;
        $this->desc  = $getCategory->desc;
    }

    public function delete($id)
    {
        Category::where('id',$id)->delete();
        session()->flash('message', 'Users Deleted Successfully.');
    }

    public function modalClose(){
        $this->emit('closeModal');
    }
}
