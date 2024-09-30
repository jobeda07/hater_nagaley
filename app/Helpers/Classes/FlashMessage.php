<?php


namespace App\Helpers\Classes;


class FlashMessage
{
    public function success($message)
    {
        session()->flash('message', $message);
    }

    public function error($message)
    {
        session()->flash('error', $message);
    }

    public function store($message, $success = true)
    {
        if ($success) {
            $this->success($message . ' added successfully');
        } else {
            $this->error('Failed to add ' . $message);
        }
    }

    public function update($message, $success = true)
    {
        if ($success) {
            $this->success($message . ' updated successfully');
        } else {
            $this->error('Failed to update ' . $message);
        }
    }

    public function delete($message, $success = true)
    {
        if ($success) {
            $this->success($message . ' deleted successfully');
        } else {
            $this->error('Failed to delete ' . $message);
        }
    }

    public function message($successMessage, $errorMessage, $success = true)
    {
        if ($success) {
            $this->success($successMessage);
        } else {
            $this->error($errorMessage);
        }
    }
}
