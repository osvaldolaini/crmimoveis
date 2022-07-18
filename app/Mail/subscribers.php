<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Model\Admin\Config;
use App\Model\Admin\Subscriber;
use App\Model\Admin\SocialMedia;

class subscribers extends Mailable
{
    use Queueable, SerializesModels;
    private $config;
    private $subscribers;
    private $socialMedia;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($content,$url,$image)
    {
        $this->config = Config::get()->first();
        $this->subscribers = Subscriber::where('active',1)->get();
        $this->socialMedia = SocialMedia::where('active',1)->get();
        $this->content = $content;
        $this->url = $url;
        $this->image = $image;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $config = $this->config;
        $socialMedia = $this->socialMedia;
        $subscribers = $this->subscribers;

        $instagram ='';
        $facebook ='';
        $youtube ='';

        foreach($socialMedia as $media){
            if($media->icon == 'fa-instagram'){
                $instagram = '<td valign="top" align="center" style="padding:0;Margin:0;padding-right:20px">
                    <a href="'.$media->link.'" target="_BLANK">
                        <img title="Instagram" src="'.url("storage/images/email/instagram-1.png").'" alt="crossfit-canoas-instagram" width="32" height="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic">
                    </a>
                </td>';
            }
            if($media->icon == 'fa-facebook'){
                $facebook = '<td valign="top" align="center" style="padding:0;Margin:0;padding-right:20px">
                    <a href="'.$media->link.'" target="_BLANK">
                        <img title="Facebook" src="'.url("storage/images/email/facebook-1.png").'" alt="crossfit-canoas-facebook" width="32" height="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic">
                    </a>
                </td>';
            }
            if($media->icon == 'fa-youtube'){
                $youtube = '<td valign="top" align="center" style="padding:0;Margin:0;padding-right:20px">
                    <a href="'.$media->link.'" target="_BLANK">
                        <img title="Youtube" src="'.url("storage/images/email/youtube.png").'" alt="crossfit-canoas-youtube" width="32" height="32" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic">
                    </a>
                </td>';
            }
        }
        $this->subject($this->content->title);
        foreach ($subscribers as $subscriber) {
            $this->bcc([$subscriber->email],'no-replay');
            $this->view('admin.email.subscriber',[
                'title_postfix' => $this->content->title,
                'config'        => $config,
                'instagram'     => $instagram,
                'facebook'      => $facebook,
                'youtube'       => $youtube,
                'link'          => $this->url,
                'image'         => $this->image,
                'title'         => $this->content->title,
            ]);
        }
    }
}
