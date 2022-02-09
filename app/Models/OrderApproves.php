<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderApproves extends Model
{
    use HasFactory;

    protected $fillable = ['fname', 'lname', 'address', 'tel', 'subdistrict', 'district', 'province', 'code_zip', 'bank', 'PaymentImage', 'paymentDate', 'paymentTime', 'bankTransfer', 'toBank', 'amount_money', 'paymentCode', 'approvel', 'alert', 'product_id', 'user_id'];
}
