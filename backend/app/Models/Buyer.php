<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int $id
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 * @property-read string|null $last_name
 * @property-read string $name
 * @property-read string|null $second_name
 * @property-read string|null $phone
 * @property-read string|null $email
 */
class Buyer extends Model
{
    use HasFactory;
}
