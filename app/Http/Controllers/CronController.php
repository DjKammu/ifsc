<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Toolkito\Larasap\SendTo;
use App\Branch;
use App\Banner;

class CronController extends Controller
{
    public function index(){

    	info(date('Y-m-d h:s'));
        
        $branch = Branch::with('bank')->inRandomOrder()->first();

        $bank_id = @$branch->bank_id;

        $query  = Banner::whereHas('banks', function($q) use ($bank_id) {
            $q->where('bank_id', $bank_id);
        });
       
        if(!$query->exists()){
         $query->orWhereNotNull('image');
        }

        $banner = $query->first();
        
        $image = url('public/uploads/'.@$banner->image);

        $branch->image = $image;

        $this->shareOnTelegram($branch);
        // $this->shareOnFacebook($lyrichord);
        // $this->shareOnWhatsapp($lyrichord);

    }


  public function shareOnTelegram($branch){

        $text = $branch['bank']['name'].', '.$branch['branch'].' '.url($branch['bank']['slug'].'/'.$branch['state_slug'].'/'.$branch['district_slug'].'/'.$branch['city_slug'].'/'.$branch['slug']);
        $file = $branch['image'];
        
        if (\App::environment('production', 'staging')) {

            SendTo::Telegram(
                $text,
                [
                    'type' => 'photo', // Message type (Required)
                    'file' => $file// Image url (Required)
                ],
                '' // Inline keyboard (Optional)
            );

        }

        return ;
    } 

    public function shareOnFacebook($lyrichord){

         $text = $lyrichord['title'].' '.url($lyrichord['slug']);
         $file = $lyrichord['image'];

        if (\App::environment('production', 'staging')) {
              SendTo::Facebook(
              'photo',
              [
                  'photo' => $file,
                  'message' => $text
              ]
          );
       }
        return ;
    }

    public function shareOnWhatsapp($lyrichord){

          $text = $lyrichord['title'].' '.url($lyrichord['slug']);
          $file = $lyrichord['image'];

          $twilio_whatsapp_number = getenv('TWILIO_WHATSAPP_NUMBER');
          $account_sid = getenv("TWILIO_SID");
          $auth_token = getenv("TWILIO_AUTH_TOKEN");

          $recipients = explode(',',getenv('WHATSAPPS_NUMBER'));
          
        if (\App::environment('production', 'staging')) {

          $twilio = new Client($account_sid, $auth_token); 

          foreach ($recipients as $key => $recipient) {
               $twilio->messages 
                ->create("whatsapp:$recipient", // to 
                         array( 
                             "from" => "whatsapp:$twilio_whatsapp_number",       
                             "body" => $text
                         ) 
                ); 
          }

        }  

        return;

     }

}
