<?php

namespace App\Http\Livewire;

use App\Models\Blog;
use Livewire\Component;
use Illuminate\Validation\Rule;
use App\Models\Category;
use App\Models\User;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;  // Laravels built in slug generator
use Illuminate\Support\Facades\DB;

class Blogs extends Component
{
    use WithPagination;
    public $modalFormVisible = false;
    public $modalConfirmDelete = false;
    public $modalConfirmDeleteVisible = false;
    public $slug;
    public $title;
    public $excerpt;
    public $body;
    public $user_id;
    public $category_id = '1';
    public $modelId;

    /**
     * Check if the required inputs contains data
     *
     * @return void
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'slug' => ['required', Rule::unique('posts','slug')->ignore($this->modelId)],
            'excerpt' => 'required',
            'category_id' => 'required'
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
        return Blog::paginate(10);
    }

    /**
     * Update records in database
     *
     * @return void
     */
    public function update()
    {
        $this->validate();
        Blog::find($this->modelId)->update($this->modelData());
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
        Blog::destroy($this->modelId);
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

    /**
     * Create page function
     * Saves to database in pages table
     * 
     * @return void
     */
    public function create()
    {
        $this->validate();
        Blog::create($this->modelData());
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
        $data = Blog::find($this->modelId);
        $this->title = $data->title;
        $this->slug = $data->slug;
        $this->excerpt = $data->excerpt;
        $this->body = $data->body;
        $this->user_id = $data->user_id;
        $this->category_id = $data->category_id;
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
            'body' => $this->body,
            'excerpt' => $this->excerpt,
            'user_id' => Auth::user()->id,
            'category_id' => $this->category_id
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
        $this->excerpt = null;
        $this->body = null;
        $this->category_id = null;
        $this->user_id = null;
        $this->modelId = null;
    }

    /**
     * The livewire render function
     *
     * @return void
     */
    public function render()
    {
        return view('livewire.blogs', [
            'data' => $this->read(),
            'categories' => Category::all(),
            'users' => User::all()
        ]);
    }
}
