<?php

namespace App\Http\Livewire;

use App\Models\Project;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class ProjectsSave extends ModalComponent
{
    use Actions;
    public Project $project;

    public $name, $contact, $email, $phone, $address, $project_id;


    /**
     * List of add/edit form rules
     */
    protected $rules = [
        'name' => 'required',
    ];

    public function mount(Project $project)
    {
        $this->project_id = $project->id;
        $this->name = $project->name;
        $this->contact = $project->contact;
        $this->email = $project->email;
        $this->phone = $project->phone;
        $this->address = $project->address;
    }


    public function render()
    {
        return view('livewire.projects-save');
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

    public function edit(Project $project){
        $this->validate();
        try {
            $project = Project::findOrFail($this->project_id);
            $project->name = $this->name;
            $project->contact = $this->contact;
            $project->email = $this->email;
            $project->phone = $this->phone;
            $project->address = $this->address;
            $project->update();
          
            $this->emit('refreshTable');
            $this->closeModal();
            $this->notification()->info(
                $title = 'Project deleted',
                $description = 'Your project was successfully updated'
            );
        } catch (\Exception $ex) {
            $this->notification()->error(
                $title = 'Error Notification',
                $description = 'Problem creating the new project, try again later.'
            );
        }
    }
}
