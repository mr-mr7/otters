<?php

namespace App\Traits;

use Jantinnerezo\LivewireAlert\LivewireAlert;

trait CustomAlert
{
    use LivewireAlert;

    public function catchAlert()
    {
        $this->alert('error', 'Something went wrong, please try again', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => false,
            'showCancelButton' => true,
            'cancelButtonText' => 'Close',
        ]);
    }

    public function alert401()
    {
        $this->alert('error', 'You do not have permission to access this area', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => false,
            'showCancelButton' => true,
            'cancelButtonText' => 'Close',
        ]);
    }

    public function successAlert($message = 'Well done!', $toast = true)
    {
        if ($toast)
            $this->alert('success', $message);
        else
            $this->alert('success', $message, [
                'position' => 'center',
                'timer' => 3000,
                'toast' => false,
                'showCancelButton' => true,
                'cancelButtonText' => 'Close',
            ]);
    }

}
