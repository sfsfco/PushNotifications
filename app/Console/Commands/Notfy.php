<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;


use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;

use App\Subscriber;
use App\Campaign;
use App\Sent;

class Notfy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Notfy:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run The Notifications Campaigns';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
         $campaigns = Campaign::where('active','1')->limit(10)->orderBy('sent', 'ASC')->orderBy('_id', 'DESC')->get();
         
        foreach ($campaigns as $camp) {
            
            $sents = Sent::where('campaign_id',$camp->id)->where('sent_date','>',strtotime("-".$camp->frequency." hours") )->get();
            $ss = array();
            $notifications = array();
            foreach ($sents as $sent) {
                $ss[]=$sent->subscriber_id;
            }
            $subscribers = new Subscriber();
            $qb = $subscribers->newQuery();
            $qb->where('_id','!=','1' );
            if($camp->country!=''){$qb->whereIn('country', explode(',', $camp->country));}
            if($camp->model!=''){$qb->whereIn('model', explode(',', $camp->model));}
            if($camp->os_version!=''){$qb->whereIn('osversion', explode(',', $camp->os_version));}
            if($camp->browser!=''){$qb->whereIn('browser', explode(',', $camp->browser));}
            if($camp->browser_version!=''){$qb->whereIn('browserversion', explode(',', $camp->browser_version));}
            if($camp->language!=''){$qb->whereIn('language', explode(',', $camp->language));}
            if($camp->connection!=''){$qb->whereIn('connection', explode(',', $camp->connection));}
            if($camp->os!=''){$qb->whereIn('os', explode(',', $camp->os));}
            if($camp->device!=''){$qb->whereIn('device', explode(',', $camp->device));}
            if($camp->brand!=''){$qb->whereIn('brand', explode(',', $camp->brand));}
            $qb->whereNotIn('id', $ss);
            $qb->limit(100);
            $results = $qb->get();
            foreach($results as $rows){
                $rows->endp = 'https://fcm.googleapis.com/fcm/send/e5ncQ2Obsww:APA91bF55dzcyhB3IOjf7qMGFKcx-bG-KKoGB7Uw2iB8pKTR5EfMMWzJ_m5ciUQOaoIWE5sUszcz2FzeqvqrokbWKVCvh2PfLffEbjof-IksIDAkQwLpO57J-P6AsuKqjw5EVYauDi3sNN2U_OXDQY2Tv1oL7ZgXAQxx';
                $rows->publicKey = 'BGdt8Ifp6s1nwuwvmxn9STgN6CkUK7RWXZiG+UvZ/ms1hnCzhBQS9T3Y+O8P1hlPW5jvCzjUULpKqyxj2cJ6B7Q=';
                $rows->authToken = 'TZRI1TVceubyyKObriv60Q==';
                $rows->contentEncoding = 'aes128gcm';
                
                $notifications[] = array('subscription'=>Subscription::create(array(
                    'endpoint' => $rows->endp,
                    'publicKey' => $rows->publicKey,
                    'authToken' => $rows->authToken,
                    'contentEncoding'=> $rows->contentEncoding,
                )),'payload'=>'{"message":"'.$camp->message.'", "topic":"'.$camp->title.'", "icon":"'.url('/images/').'/'.$camp->icon.'", "image":"'.url('/images/').'/'.$camp->image.'", "link":"'.$camp->link.'", "explore":"'.$camp->explore.'", "explore_icon":"'.url('/images/').'/'.$camp->explore_icon.'", "dir":"'.$camp->direction.'"}');
            
            Sent::create(['campaign_id' => $camp->id,'subscriber_id'=>$rows->id,'sent_date'=>time()]);
                
            }
            $camp->update(['sent' => time() ]);
            
        }
        $notification = array('subscription'=>Subscription::create(array(
                    'endpoint' => 'https://fcm.googleapis.com/fcm/send/e5ncQ2Obsww:APA91bF55dzcyhB3IOjf7qMGFKcx-bG-KKoGB7Uw2iB8pKTR5EfMMWzJ_m5ciUQOaoIWE5sUszcz2FzeqvqrokbWKVCvh2PfLffEbjof-IksIDAkQwLpO57J-P6AsuKqjw5EVYauDi3sNN2U_OXDQY2Tv1oL7ZgXAQ',
                    'publicKey' => 'BGdt8Ifp6s1nwuwvmxn9STgN6CkUK7RWXZiG+UvZ/ms1hnCzhBQS9T3Y+O8P1hlPW5jvCzjUULpKqyxj2cJ6B7Q=',
                    'authToken' => 'TZRI1TVceubyyKObriv60Q==',
                    'contentEncoding'=> 'aes128gcm',
                )),'payload'=>'{"message":"'.$campaigns[0]->message.'", "topic":"'.$campaigns[0]->title.'", "icon":"'.url('/images/').'/'.$campaigns[0]->icon.'", "image":"'.url('/images/').'/'.$campaigns[0]->image.'", "link":"'.$campaigns[0]->link.'", "explore":"'.$campaigns[0]->explore.'", "explore_icon":"'.url('/images/').'/'.$campaigns[0]->explore_icon.'", "dir":"ltr"}');
            
        array_push($notifications,$notification);
        
        $auth = array(
            'VAPID' => array(
                'subject' => 'https://github.com/Minishlink/web-push-php-example/',
                'publicKey' => 'BOgBeFl4_H-5FfVl7iXu-M12bJKNldSWsfzHz_XWkHu5PbEpHeksl1xAysuMQPH72-BFU9ot81beWxjbG5GypEw',
                'privateKey' => 'pH_E24iQASSELPbPPhZoNQ1dNaLxOXq2Bwi3Hm_RrTE', // in the real world, this would be in a secret file
            ),
        );
        
        $webPush = new WebPush($auth);

        foreach ($notifications as $notification) {

            $webPush->sendNotification( $notification['subscription'], $notification['payload'] );
        }
        $webPush->flush();
        
        unset($notifications);
        echo 'Done';
    }
    
}
