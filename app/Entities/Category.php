<?php

namespace App\Entities;

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Category.
 *
 * @package namespace App\Entities;
 */
class Category extends Model implements TableInterface
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    public function getTableHeaders()
    {
        return ['#', 'Nome'];
    }

    public function getValueForHeader($header)
    {
        switch($header){
            case '#':
                return $this->id;
            case 'Nome':
                return $this->name;
        }
    }

}
