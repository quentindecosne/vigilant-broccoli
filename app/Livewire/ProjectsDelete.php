<?php

namespace App\Livewire;

use App\Models\Project;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class ProjectsDelete extends ModalComponent
{
    use Actions;

    public Project $project;

    public function render()
    {
        return view('livewire.projects-delete');
    }

    public function delete()
    {
        try {
            $project = $this->project;
            $this->project->delete();
            $this->dispatch('refreshTable');
            $this->closeModal();
            activity('recent')->event('warning')->withProperties(['project' => $project->name, 'project_id' => $project->project_id])->log(':causer.name has deleted the project: :properties.project');
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
