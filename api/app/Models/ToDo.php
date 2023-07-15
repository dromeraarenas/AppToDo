<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ToDo extends Model
{
    use HasFactory;

    private $id;
    private $user_id;
    private $name;
    private $description;
    private $status;
    private $categories;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'status'
    ];

    public function categories(): BelongsToMany
    {
        return $this->BelongsToMany(Category::class,'to_dos_categories');
    }
   
}