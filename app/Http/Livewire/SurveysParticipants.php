<?php

namespace App\Http\Livewire;

use App\Models\Survey;
use App\Models\User;
use Illuminate\Support\Arr;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class SurveysParticipants extends ModalComponent
{
    use Actions;

    public Survey $survey;

    public $participants;

    public $users;

    public $add_user;

    public function mount()
    {
        $this->users = User::get();
        $this->participants = [];
        $survey = Survey::with('participants')->where('id', '=', $this->survey->id)->get();
        $participants = $survey->flatMap->participants;
        foreach ($participants as $user) {
            $this->participants = Arr::prepend($this->participants, $user);
        }
    }

    public function render()
    {
        return view('livewire.surveys-participants');
    }

    public function addParticipant()
    {
        if (! Arr::has($this->participants, $this->add_user)) {
            $user = User::where('id', '=', $this->add_user)->get(['id', 'name', 'email'])->firstOrFail();
            $this->participants = Arr::prepend($this->participants, $user);
        }
    }

    public function deleteParticipant($participantId)
    {
        $filteredArray = array_filter($this->participants, function ($item) use ($participantId) {
            return $item['id'] !== $participantId;
        });
        $this->participants = $filteredArray;
    }

    public function save()
    {
        if ($this->participants) {
            try {
                $this->survey->participants()->sync(array_column($this->participants, 'id'));
                $this->closeModal();
                $this->notification()->info(
                    $title = 'Participants updated',
                    $description = 'The participants were successfully updated'
                );
            } catch (\Exception $ex) {
                $this->notification()->error(
                    $title = 'Error Notification',
                    $description = 'Problem updating the participants, try again later.'
                );
            }
        } else {
            $this->closeModal();
        }
    }
}
