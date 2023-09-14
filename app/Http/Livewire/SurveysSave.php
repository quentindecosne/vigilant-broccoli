<?php

namespace App\Http\Livewire;

use App\Models\Survey;
use App\Models\Project;
use WireUi\Traits\Actions;
use LivewireUI\Modal\ModalComponent;

class SurveysSave extends ModalComponent
{

    use Actions;
    public Survey $survey;
    public $projects, $name, $project_id;

    /**
     * List of add/edit form rules
     */
    protected $rules = [
        'name' => 'required',
        'project_id' => 'required'
    ];

    protected $messages = [
        'project_id.required' => 'A project must be selected.',
    ];


    public function mount(Project $project)
    {
        $this->projects = Project::orderBy('name')->get(["name", "id"]);
    }

    public function render()
    {
        return view('livewire.surveys-save');
    }

    public function save(){
        $this->validate();
        // try {
            Survey::create([
                'name' => $this->name,
                'project_id' => $this->project_id,
            ]);
            $this->emit('refreshTable');
            $this->closeModal();
            $this->notification()->info(
                $title = 'Survey created',
                $description = 'Your survey was successfully created'
            );
        // } catch (\Exception $ex) {
        //     $this->notification()->error(
        //         $title = 'Error Notification',
        //         $description = 'Problem creating the new survey, try again later.'
        //     );
        // }
    }
}
