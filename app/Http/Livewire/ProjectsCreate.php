<?php

namespace App\Http\Livewire;

use App\Models\Project;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class ProjectsCreate extends ModalComponent
{
    use Actions;
    // public Project $project;
    public $name, $contact, $email, $phone, $address;


    /**
     * List of add/edit form rules
     */
    protected $rules = [
        'name' => 'required',
    ];


    public function render()
    {
        return view('livewire.projects-create');
    }

    public function save(){
        $this->validate();
        try {
            Project::create([
                'name' => $this->name,
                'contact' => $this->contact,
                'email' => $this->email,
                'phone' => $this->phone,
                'address' => $this->address,
            ]);
            $this->emit('refreshTable');
            $this->closeModal();
            $this->notification()->info(
                $title = 'Project deleted',
                $description = 'Your project was successfully created'
            );
        } catch (\Exception $ex) {
            $this->notification()->error(
                $title = 'Error Notification',
                $description = 'Problem creating the new project, try again later.'
            );
        }
    }
}
