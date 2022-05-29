<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\ImageUpload;
use Livewire\WithPagination;

class Gallery extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $modalFormVisible = false;
    public $modalConfirmDelete = false;
    public $modalConfirmDeleteVisible = false;
    public $fileTitle, $fileName, $modelId;

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function submit()
    {
        $dataValid = $this->validate([
            'fileTitle' => 'required',
            'fileName' => 'required|image|mimes:jpg,jpeg,png,svg,gif|max:2048',
        ]);
  
        $dataValid['fileName'] = $this->fileName->store('galleries', 'public');
  
        ImageUpload::create($dataValid);
  
        session()->flash('message', 'File uploaded.');
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
        return ImageUpload::paginate(10);
    }
    

    /**
     * Delete record from database
     *
     * @return void
     */
    public function delete()
    {
        ImageUpload::destroy($this->modelId);
        $this->modalConfirmDeleteVisible = false;
        $this->resetPage();
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
        $data = ImageUpload::find($this->modelId);
        $this->fileTitle = $data->fileTitle;
        $this->fileName = $data->fileName;
    }

    /**
     * Data for the model
     *
     * @return void
     */
    public function modelData()
    {
        return [
            'fileTitle' => $this->fileTitle,
            'fileName' => $this->fileName,
        ];
    }

    /**
     * Clear the the modal form data
     *
     * @return void
     */
    public function clearInputs()
    {
        $this->fileTitle = null;
        $this->fileName = null;
        $this->modelId = null;
    }

    public function render()
    {
        return view('livewire.gallery', [
            'data' => $this->read()
        ]);
    }
}
