<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class CashAdvanceRequest extends Model
{

    public function staff(){
        return $this->belongsTo("App\User", "staff_id", "id");
    }

    public function admin(){
        return $this->belongsTo("App\User", "issuer_id", "id");
    }


    public function generateTicketID(){
        $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $ticketID = substr(str_shuffle($permitted_chars), 0, 10);
        $tickets = PettyCashRequest::where('ticket_id', $ticketID)->count();
        if($tickets > 0){
            $this->generateTicketID();
        }
        else{
            return $ticketID;
        }
    }
}
