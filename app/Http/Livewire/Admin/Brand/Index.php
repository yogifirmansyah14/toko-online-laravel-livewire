<?php

namespace App\Http\Livewire\Admin\Brand;

use App\Models\Brand;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $name, $slug, $status, $brand_id, $category_id;
    
    public function rules()
    {
        return [
            'name' => 'required|string',
            'slug' => 'required|string',
            'category_id' => 'required|integer',
            'status' => 'nullable'
        ];
    }

    public function resetInput()
    {
        $this->name = NULL;
        $this->slug = NULL;
        $this->status = NULL;
        $this->brand_id = NULL;
        $this->category_id = NULL;
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function openModal()
    {
        $this->resetInput();
    }

    public function storeBrand()
    {
        $validatedData = $this->validate();
        Brand::create([
            'name' => $this->name,
            'category_id' => $this->category_id,
            'slug' => Str::slug($this->slug),
            'status' => $this->status == true ? '1':'0',
        ]);
        session()->flash('message', 'Brand Added Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function editBrand(int $brand_id)
    {
        $this->brand_id = $brand_id;
        $brand = Brand::findOrFail($brand_id);
        $this->name = $brand->name;
        $this->category_id = $brand->category_id;
        $this->slug = $brand->slug;
        $this->status = $brand->status;
    }

    public function updateBrand()
    {
        $validatedData = $this->validate();
        Brand::findOrFail($this->brand_id)->update([
            'name' => $this->name,
            'category_id' => $this->category_id,
            'slug' => Str::slug($this->slug),
            'status' => $this->status == true ? '1':'0',
        ]);
        session()->flash('message', 'Brand Updated Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function deleteBrand($brand_id)
    {
        $this->brand_id = $brand_id;
    }

    public function destroyBrand()
    {
        $brand = Brand::findOrFail($this->brand_id);
        $brand->delete();
        session()->flash('message', 'Brand Deleted Successfully');
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }

    public function render()
    {
        $categories = Category::where('status', '0')->get();
        $brands = Brand::orderBy('id', 'DESC')->paginate(3);
        return view('livewire.admin.brand.index', ['brands' => $brands, 'categories' => $categories])->extends('layouts.admin')->section('content');
    }
}
