<?php

namespace App\Http\Livewire;

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

    public function delete(){
        try{
            $this->survey->delete();
            $this->emit('refreshTable');
            $this->closeModal();
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
