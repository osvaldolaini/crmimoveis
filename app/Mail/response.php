<?php

namespace App\Mail;

use App\Model\Admin\Email;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Model\Admin\Config;
use App\Model\Admin\SocialMedia;

class response extends Mailable
{
    use Queueable, SerializesModels;
    private $config;
    private $email;

    private $socialMedia;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email)
    {
        $this->config = Config::get()->first();
        $this->email = $email;
        $this->socialMedia = SocialMedia::where('active',1)->get();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $config = $this->config;
        $email = $this->email;
        
        $socialMedia = $this->socialMedia;
        $instagram ='';
        $facebook ='';
        $youtube ='';
        foreach($socialMedia as $media){
            if($media->icon == 'fa-instagram'){
                $instagram = '<td>
                    <a href="'.$media->link.'" target="_BLANK">
                        <img src="'.url("storage/images/email/instagram-1.png").'" alt="crossfit-canoas-instagram" width="38" height="38" style="display: block;" border="0" />
                    </a>
                </td>';
            }
            if($media->icon == 'fa-facebook'){
                $facebook = '<td>
                    <a href="'.$media->link.'" target="_BLANK">
                        <img src="'.url("storage/images/email/facebook-1.png").'" alt="crossfit-canoas-facebook" width="38" height="38" style="display: block;" border="0" />
                    </a>
                </td>';
            }
            if($media->icon == 'fa-youtube'){
                $youtube = '<td>
                    <a href="'.$media->link.'" target="_BLANK">
                        <img src="'.url("storage/images/email/youtube.png").'" alt="crossfit-canoas-youtube" width="38" height="38" style="display: block;" border="0" />
                    </a>
                </td>';
            }
        }
        $this->subject($email->subject);
        //foreach ($this->partners as $partner) {
            $this->to([$email->from],[$email->customer]);
            //$this->to('osvaldolaini@hotmail.com','osvaldolaini');
            //$this->bcc([$partner->email]);
            $this->view('admin.email.response',[
                'title_postfix' => $email->subject,
                'config'        => $config,
                'email'         => $email,
                'instagram'     => $instagram,
                'facebook'      => $facebook,
                'youtube'       => $youtube,
            ]);
        //}
    }
}
