<?php

namespace App\Http\Livewire;

use App\Models\Project;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;


class ProjectsDelete extends ModalComponent
{

    use Actions;
    public Project $project;


    public function render()
    {
        return view('livewire.projects-delete', ['project'=> $this->project, 'formAction'=> 'destroy']);
    }    

    public function delete(){
        try{
            $this->project->delete();
            $this->emit('refreshTable');
            $this->closeModal();
            $this->notification()->info(
                $title = 'Project deleted',
                $description = 'Your project was successfully deleted'
            );
        } catch (\Throwable $e) {
            $this->notification()->error(
                $title = 'Error Notification',
                $description = 'Problem deleting, try again later.'
            );
        }
    }



}
