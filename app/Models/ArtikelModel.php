<?php
namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class ArtikelModel extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;
    protected $table = 'articles';
    protected $fillable = [
        'title',
        'content',
        'image',
        'user_id',
        'category_id'
    ];
}
