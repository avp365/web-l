<?php

namespace App\Jobs\Construction;


use App\Models\User;

use App\Services\Constructions\ConstructionsService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;


class ConstructionCreateProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** @var User */

    protected $id;
    protected $data;


    public function __construct($arg)
    {
        $this->id = $arg['id'];
        $this->data = $arg['data'];

    }

    public function handle(ConstructionsService $constructionsService)
    {


        $construction = $constructionsService->find($this->id);
        $constructionsService->createOrUpdateConstruction($construction,$this->data);

    }

}
