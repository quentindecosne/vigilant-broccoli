<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Survey;
use DebugBar\DebugBar;
use WireUi\Traits\Actions;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use LivewireUI\Modal\ModalComponent;

class SurveysParticipants extends ModalComponent
{

    use Actions;
    public Survey $survey;
    public $participants;

    public function mount()
    {
        $this->participants = [];
        if ($this->survey->participants){
            $participants = Str::of($this->survey->participants)->explode(',');
            foreach($participants as $participant){
                $user = User::where('id','=', $participant)->get(['id', 'name', 'email'])->firstOrFail();
                $this->participants = Arr::prepend($this->participants,$user);
            }
        }
    }

    public function render()
    {
        return view('livewire.surveys-participants');
    }

    public function deleteParticipant($participantId)
    {
        $filteredArray = array_filter($this->participants, function($item) use ($participantId) {
            return $item['id'] !== $participantId;
        });
        $this->participants = $filteredArray;
    }

    public function save(){
        if ($this->participants){
            try {
                $this->survey->participants = implode(',', array_column($this->participants, 'id'));
                $this->survey->save();
                $this->closeModal();
                $this->notification()->info(
                    $title = 'Participant removed',
                    $description = 'The participant was successfully removed'
                );
            } catch (\Exception $ex) {
                $this->notification()->error(
                    $title = 'Error Notification',
                    $description = 'Problem deleting the participant, try again later.'
                );
            }
        }
        else{
            $this->closeModal();
        }
    }
}
