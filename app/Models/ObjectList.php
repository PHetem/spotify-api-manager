<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjectList extends Model
{
    use HasFactory;

    public $items;
    private $type;

    public function __construct($type, $list) {
        $this->type = $type;
        $this->mapItems($list);
    }

    public function mapItems($list) {
        foreach ($list as $item) {
            $this->items[] = new $this->type($item);
        }
    }
}
