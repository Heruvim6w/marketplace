<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string|null $last_name
 * @property string $name
 * @property string|null $second_name
 * @property string|null $phone
 * @property string|null $email
 */
class Buyer extends Model
{
    use HasFactory;
}
