<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'password', 'birth_date',
    ];
    protected $hidden = [
        'password',
    ];
    protected $dates = ['deleted_at'];
    public function cars()
    {
        return $this->belongsToMany(Car::class, 'car_user');
    }
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($user) {
            $user->password = Hash::make($user->password);
        });
    }
}
