<?php

namespace App\Livewire;

use App\Models\Project;
use App\Models\Survey;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class SurveysMerge extends ModalComponent
{
    use Actions;

    public Survey $survey;

    public $projects;

    public $survey_id;

    public $name;

    public $project_id;

    /**
     * List of add/edit form rules
     */
    protected $rules = [
        'name' => 'required',
        'project_id' => 'required',
    ];

    public function mount(Survey $survey)
    {
        //        dd($survey);
        $this->projects = Project::orderBy('name')->get(['name', 'id']);
        $this->survey_id = $survey->id;
        $this->name = $survey->name;
        $this->project_id = $survey->project_id;
    }

    protected $messages = [
        'project_id.required' => 'A project must be selected.',
    ];

    public function render()
    {
        return view('livewire.surveys-merge');
    }
}
