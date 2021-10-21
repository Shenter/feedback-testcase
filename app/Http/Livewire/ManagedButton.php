<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Feedback;

class ManagedButton extends Component
{

    public function mount($feedbackId)
    {
        $this->feedbackId = $feedbackId;
        $this->is_managed = false;
    }

    public function markAsManaged()
    {
        $feedback = Feedback::find ($this->feedbackId);
        $feedback->is_managed = true;
        $feedback->save();
        $this->is_managed = true;

    }
    public function render()
    {

        return view('livewire.managed-button',['feedbackId'=>$this->feedbackId]);
    }
}
