<?php

namespace App\Http\Livewire;

use App\Models\NavigationMenu;
use Livewire\Component;
use Livewire\WithPagination;

class NavigationMenus extends Component
{

    use WithPagination;
    public $modalFormVisible;
    public $modalConfirmDeleteVisible;
    public $modelId;
    public $label;
    public $slug;
    public $sequence = 1;
    public $type = 'Menu';
    public $menuid;

    public function rules()
    {
        return [
            'label' => 'required',
            'slug' => 'required',
            'sequence' => 'required',
            'type' => 'required',
        ];
    }

    public function checkData($type,$submenu)
    {
        // make sure user cannot be under a menu item if type is menu
        if($type === 'SubMenu' && $submenu || $type === 'Menu' && !$submenu) {
            return true;
        }

        // return true or false
    }

    public function create()
    {
        $this->validate();
        if($this->checkData($this->type, $this->menuid)) {
            NavigationMenu::create($this->modelData());
            $this->modalFormVisible = false;
            $this->reset();
        } else {
            $this->addError('menuid', 'Sub menu items must have a predecessor while menu items cannot.');
        }
        
        
    }

    public function update()
    {
        $this->validate();
        if($this->checkData($this->type, $this->menuid)) {
            NavigationMenu::find($this->modelId)->update($this->modelData());
            $this->modalFormVisible = false;
            $this->reset();
        } else {
            $this->addError('menuid', 'Sub menu items must have a predecessor while menu items cannot.');
        }
    }

    public function delete()
    {
        NavigationMenu::destroy($this->modelId);
        $this->modalConfirmDeleteVisible = false;
        $this->reset();
    }

    public function read()
    {
        return NavigationMenu::paginate(5);
    }

    public function readAll()
    {
        return NavigationMenu::all();
    }

    public function createShowModal()
    {
        $this->resetValidation();
        $this->reset();
        $this->modalFormVisible = true;
    }

    public function updateShowModal($id)
    {
        $this->resetValidation();
        $this->modelId = $id;
        $this->modalFormVisible = true;
        $this->loadModal();
    }

    public function deleteShowModal($id)
    {
        $this->modelId = $id;
        $this->modalConfirmDeleteVisible = true;
    }

    private function loadModal()
    {
        $data = NavigationMenu::find($this->modelId);
        $this->type = $data->type;
        $this->sequence = $data->sequence;
        $this->label = $data->label;
        $this->slug = $data->slug;
        $this->menuid = $data->menuid;
    }

    public function modelData()
    {
        return [
            'label' => $this->label,
            'slug' => $this->slug,
            'sequence' => $this->sequence,
            'type' => $this->type,
            'menuid' => $this->menuid,
        ];
    }

    public function render()
    {
        return view('livewire.navigation-menus', [
            'data' => $this->read(),
            'allData' => $this->readAll(),
        ]);
        
    }
}
