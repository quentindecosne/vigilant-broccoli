<?php

namespace App\Livewire;

use App\Models\Survey;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class SurveysDelete extends ModalComponent
{
    use Actions;

    public Survey $survey;

    public function render()
    {
        return view('livewire.surveys-delete');
    }

    public function delete()
    {
        try {
            $survey = $this->survey;
            $this->survey->delete();
            $this->dispatch('refreshTable');
            $this->closeModal();
            activity('recent')->event('warning')->withProperties(['survey' => $survey->name, 'survey_id' => $survey->id])->log(':causer.name has deleted the survey: :properties.survey');
            $this->notification()->info(
                $title = 'Survey deleted',
                $description = 'Your survey was successfully deleted'
            );
        } catch (\Throwable $e) {
            $this->notification()->error(
                $title = 'Error Notification',
                $description = 'Problem deleting, try again later.'
            );
        }
    }
}
