<?php

namespace App\Http\Livewire;

use App\Models\Testimonial;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;

class Testimonials extends Component
{
    use WithPagination;
    public $modalFormVisible = false;
    public $modalConfirmDelete = false;
    public $modalConfirmDeleteVisible = false;
    public $testimonial;
    public $author;
    public $modelId;

    /**
     * Check if the required inputs contains data
     *
     * @return void
     */
    public function rules()
    {
        return [
            'testimonial' => 'required',
            'author' => 'required'
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
        return Testimonial::paginate(10);
    }

    /**
     * Update records in database
     *
     * @return void
     */
    public function update()
    {
        $this->validate();
        Testimonial::find($this->modelId)->update($this->modelData());
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
        Testimonial::destroy($this->modelId);
        $this->modalConfirmDeleteVisible = false;
        $this->resetPage();
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
        Testimonial::create($this->modelData());
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
        $data = Testimonial::find($this->modelId);
        $this->testimonial = $data->testimonial;
        $this->author = $data->author;
    }

    /**
     * Data for the model
     *
     * @return void
     */
    public function modelData()
    {
        return [
            'testimonial' => $this->testimonial,
            'author' => $this->author,
        ];
    }

    /**
     * Clear the the modal form data
     *
     * @return void
     */
    public function clearInputs()
    {
        $this->testimonial = null;
        $this->author = null;
        $this->modelId = null;
    }

    public function render()
    {
        return view('livewire.testimonials', [
            'data' => $this->read()
        ]);
    }
}
