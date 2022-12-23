<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssemblyGroupNode extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "assemblygroupnodes";

    protected $guarded = [];

    public function genericArticle()
    {
        return $this->hasMany(GenericArticle::class);
    }
    public function articleVehicleTree()
    {
        return $this->hasMany(ArticleVehicleTree::class,'assemblyGroupNodeId','assemblyGroupNodeId');
    }

}
