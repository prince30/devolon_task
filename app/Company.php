<?php
namespace App;

use Franzose\ClosureTable\Models\Entity;

class company extends Entity implements companyInterface
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'companies';

    /**
     * ClosureTable model instance.
     *
     * @var companyClosure
     */
    protected $closure = 'App\companyClosure';

    protected $fillable=['name','company_id'];

    public function stations()
    {
        return $this->hasMany('App\Station');
    }
}
