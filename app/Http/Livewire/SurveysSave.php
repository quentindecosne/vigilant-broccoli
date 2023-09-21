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
        return view('livewire.surveys-save');
    }

    public function save(){
        $this->validate();
        try {
            $survey = Survey::create([
                'name' => $this->name,
                'project_id' => $this->project_id,
            ]);
            $this->emit('refreshTable');
            $this->closeModal();
            activity('recent')->event('success')->withProperties(['survey' => $this->name, 'survey_id' => $survey->id])->log(':causer.name has created the survey: :properties.survey');
            $this->notification()->info(
                $title = 'Survey created',
                $description = 'Your survey was successfully created'
            );
        } catch (\Exception $ex) {
            $this->notification()->error(
                $title = 'Error Notification',
                $description = 'Problem creating the new survey, try again later.'
            );
        }
    }


    public function edit(Survey $survey){
        $this->validate();
        try {
            $survey = Survey::findOrFail($this->survey_id);
            $survey->name = $this->name;
            $survey->project_id = $this->project_id;
            $survey->update();
          
            $this->emit('refreshTable');
            $this->closeModal();
            activity('recent')->event('info')->withProperties(['survey' => $this->name, 'survey_id' => $this->survey_id])->log(':causer.name has modified the survey: :properties.survey');
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
