<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    // The attributes that are mass assignable
    protected $table='sites';
    protected $fillable = ['name', 'description'];

    public function images()
    {
        return $this->hasMany(SiteImage::class);
    }

}
