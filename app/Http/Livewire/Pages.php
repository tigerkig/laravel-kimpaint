<?php

namespace App\Http\Livewire;

use App\Models\Page;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;  // Laravels built in slug generator

class Pages extends Component
{
    use WithPagination;
    public $modalFormVisible = false;
    public $modalConfirmDelete = false;
    public $modalConfirmDeleteVisible = false;
    public $slug;
    public $title;
    public $content;
    public $modelId;
    public $isSetToDefaultHomePage;
    public $isSetToDefaultNotFoundPage;
    
    /**
     * Check if the required inputs contains data
     *
     * @return void
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'slug' => ['required', Rule::unique('pages','slug')->ignore($this->modelId)],
            'content' => 'required',
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
        return Page::paginate(5);
    }
    
    /**
     * Update records in database
     *
     * @return void
     */
    public function update()
    {
        $this->validate();
        $this->unassignDefaultHomePage();
        $this->unassignDefaultNotFoundPage();
        Page::find($this->modelId)->update($this->modelData());
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
        Page::destroy($this->modelId);
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
    public function updatedTitle($value)
    {
        $this->slug = Str::slug($value);
    }

    public function updatedIsSetToDefaultHomePage()
    {
        $this->isSetToDefaultNotFoundPage = null;
    }

    public function updatedIsSetToDefaultNotFoundPage()
    {
        $this->isSetToDefaultHomePage = null;
    }

    // private function generateSlug($value)
    // {
    //     $replaceSpace = str_replace(' ', '-', $value);
    //     $lowerCase = strtolower($replaceSpace);
    //     $this->slug = $lowerCase;
    // }
    
    /**
     * Create page function
     * Saves to database in pages table
     * 
     * @return void
     */
    public function create()
    {
        $this->validate();
        $this->unassignDefaultHomePage();
        $this->unassignDefaultNotFoundPage();
        Page::create($this->modelData());
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
        $data = Page::find($this->modelId);
        $this->title = $data->title;
        $this->slug = $data->slug;
        $this->content = $data->content;
        $this->isSetToDefaultHomePage = !$data->is_default_home ? null : true;
        $this->isSetToDefaultNotFoundPage = !$data->is_default_not_found ? null : true;
    }
    
    /**
     * Data for the model
     *
     * @return void
     */
    public function modelData()
    {
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'is_default_home' => $this->isSetToDefaultHomePage,
            'is_default_not_found' => $this->isSetToDefaultNotFoundPage,
        ];
    }
    
    /**
     * Clear the the modal form data
     *
     * @return void
     */
    public function clearInputs()
    {
        $this->title = null;
        $this->slug = null;
        $this->content = null;
        $this->modelId = null;
        $this->isSetToDefaultHomePage = null;
        $this->isSetToDefaultNotFoundPage = null;
    }
    
    /**
     * Unassigns default home page on update
     *
     * @return void
     */
    private function unassignDefaultHomePage()
    {
        if($this->isSetToDefaultHomePage != null) {
            Page::where('is_default_home', true)->update([
                'is_default_home' => false,
            ]);
        }
    }
    
    /**
     * Unassigns default error page on update
     *
     * @return void
     */
    private function unassignDefaultNotFoundPage()
    {
        if($this->isSetToDefaultNotFoundPage != null) {
            Page::where('is_default_not_found', true)->update([
                'is_default_not_found' => false,
            ]);
        }
    }
    
    /**
     * The livewire render function
     *
     * @return void
     */
    public function render()
    {
        return view('livewire.pages', [
            'data' => $this->read(),
        ]);
    }
}
