<?php

namespace App\Http\Livewire\Project;

use App\Models\Project;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;


class Delete extends ModalComponent
{

    use Actions;
    public Project $project;
    
    public function mount(Project $project)
    {
        $this->project = $project;
    }

    public function destroy(){
        try{
            //$this->project->delete();
            $this->emit('refreshTable');
            $this->closeModal();
            // $this->dispatchBrowserEvent('notify','Project has been deleted');
            $this->notification()->info(
                $title = 'Project deleted',
                $description = 'Your project was successfully deleted'
            );
        } catch (\Throwable $e) {
            $this->notification()->error(
                $title = 'Error Notification',
                $description = 'Problem deleting, try again later.'
            );
            // notify()->error('toast_error', 'Problem deleting, try again later.');
        }
    }


    public function render()
    {
        return view('livewire.project.delete', ['project'=> $this->project, 'formAction'=> 'destroy']);
    }
}
