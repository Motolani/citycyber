<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{

    public function cashiers(){
        return $this->hasMany('App\CashierWallet', 'office_id', 'id');
    }

    public function staffs(){
        return $this->hasMany('App\User', 'office_id', 'id');
    }

    public function shopWallet(){
        return $this->hasOne('App\ShopWallet', 'office_id', 'id');
    }


    public function cashReserve(){
        return $this->hasOne('App\CashReserveWallet', 'office_id', 'id');
    }

    public function manager(){
        return $this->belongsTo('App\User', 'managerid', 'id');
    }

    public function state(){
        return $this->hasOne('App\States', 'id', 'state_id');
    }

    public function country(){
        return $this->hasOne('App\Countries', 'id', 'country_id');
    }
    public function city(){
        return $this->hasMany('App\Cities', 'id', 'city_id');
    }

    public function photos(){
        return $this->hasMany('App\Photo', 'office_id', 'id')->latest();
    }

    public function getDefaultPhoto() {
        $default = $this->photos->where('is_default', true)->first();
        if (!isset($default)){
            if(isset($this->photos)) {
                $default = $this->photos->get()[0];
            }
            else{
                $default = "uploads/none.png";
            }
        }
        return $default;
    }

    public function getDefaultPhotoPath() {
        $default = $this->photos->where('is_default', true)->first();
        if (!isset($default)){
            if(count($this->photos) > 0) {
                $default = $this->photos[0]->path;
            }
            else{
                $default = "uploads/none.png";
            }
        }
        else{
            $default = $default->path;
        }
        return $default;
    }

}
