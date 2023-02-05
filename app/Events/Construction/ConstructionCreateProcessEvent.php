<?php

namespace App\Events\Construction;

use Illuminate\Queue\SerializesModels;

class ConstructionCreateProcessEvent
{
    use SerializesModels;

    public $id;
    public $data;


    public function __construct($id,array $data)
    {

        $this->id = $id;
        $this->data = $data;
    }
}
