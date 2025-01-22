<?php
namespace App\Traits;

use App\Models\CustomModel;
use NotFoundEntityException;

trait ItemRepositoryTrait
{
    protected $model;

    public function __construct(CustomModel $model)
    {
        $this->model = $model;
    }

    public function getItem($id)
    {
        $item = $this->model->getU->find($id);

        if (!$item)
        {
            throw new NotFoundEntityException("Item not found", sprintf("number", $id));
        }
        
        return $item;
    }
}
