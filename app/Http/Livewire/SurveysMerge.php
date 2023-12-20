<?php

namespace App\Http\Livewire;

use App\Models\Survey;
use App\Models\Project;
use WireUi\Traits\Actions;
use LivewireUI\Modal\ModalComponent;

class SurveysMerge extends ModalComponent
{

    use Actions;
    public Survey $survey;
    public $projects, $survey_id, $name, $project_id;


    /**
     * List of add/edit form rules
     */
    protected $rules = [
        'name' => 'required',
        'project_id' => 'required'
    ];

    public function mount(Survey $survey)
    {
//        dd($survey);
        $this->projects = Project::orderBy('name')->get(["name", "id"]);
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
