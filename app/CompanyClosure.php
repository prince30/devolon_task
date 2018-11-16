<?php
namespace App;

use Franzose\ClosureTable\Models\ClosureTable;

class companyClosure extends ClosureTable implements companyClosureInterface
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'company_closure';
}
