<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;
use Illuminate\Support\Str;  // Laravels built in slug generator

class Categories extends Component
{
    use WithPagination;
    public $modalFormVisible = false;
    public $modalConfirmDelete = false;
    public $modalConfirmDeleteVisible = false;
    public $slug;
    public $name;
    public $modelId;

    /**
     * Check if the required inputs contains data
     *
     * @return void
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'slug' => ['required', Rule::unique('categories','slug')->ignore($this->modelId)],
        ];
    }

    /**
     * Mount live wire component
     *
     * @return void
     */
    public function mount()
    {
        // Reset pagination on page load
        $this->resetPage();
    }

    public function read()
    {
        return Category::paginate(10);
    }

    /**
     * Update records in database
     *
     * @return void
     */
    public function update()
    {
        $this->validate();
        Category::find($this->modelId)->update($this->modelData());
        $this->modalFormVisible = false;
        $this->reset();
    }

    /**
     * Delete record from database
     *
     * @return void
     */
    public function delete()
    {
        Category::destroy($this->modelId);
        $this->modalConfirmDeleteVisible = false;
        $this->resetPage();
    }

    /**
     * Updates slug each key stroke
     * Removes unnecessary white space
     * Changes whitespace to dash
     * Turns all characters to lowercase
     *
     * @param  mixed $value
     * @return void
     */
    public function updatedName($value)
    {
        $this->slug = Str::slug($value);
    }

    /**
     * Create page function
     * Saves to database in pages table
     * 
     * @return void
     */
    public function create()
    {
        $this->validate();
        Category::create($this->modelData());
        $this->modalFormVisible = false;
        $this->reset();
    }

    /**
     * Shows the form modal
     * of the create function
     *
     * @return void
     */
    public function createShowModal()
    {
        $this->resetValidation();
        $this->reset();
        $this->modalFormVisible = true;
    }

    /**
     * Show update modal
     * Call loadModal function to retrieve data based on id
     * 
     * @param  mixed $id
     * @return void
     */
    public function updateShowModal($id)
    {
        $this->resetValidation();
        $this->modelId = $id;
        $this->modalFormVisible = true;
        $this->loadModal();
    }

    /**
     * Show delete page confirmation modal
     *
     * @param  mixed $id
     * @return void
     */
    public function deleteShowModal($id)
    {
        $this->modelId = $id;
        $this->modalConfirmDeleteVisible = true;
    }

    /**
     * Loads data based on id
     * Updates variables to the data retrieved
     *
     * @return void
     */
    private function loadModal()
    {
        $data = Category::find($this->modelId);
        $this->name = $data->name;
        $this->slug = $data->slug;
    }

    /**
     * Data for the model
     *
     * @return void
     */
    public function modelData()
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
        ];
    }

    /**
     * Clear the the modal form data
     *
     * @return void
     */
    public function clearInputs()
    {
        $this->name = null;
        $this->slug = null;
        $this->modelId = null;
    }

    /**
     * The livewire render function
     *
     * @return void
     */
    public function render()
    {
        return view('livewire.categories', [
            'data' => $this->read()
        ]);
    }
}
