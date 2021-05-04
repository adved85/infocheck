<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailNotify extends Mailable
{
    use Queueable, SerializesModels;

    public $params;
    public $from_name;
    public $from_email;

    public $subject;
    public $name;
    public $template;
    public $template_type; // if we have markdown it uses for calling markdown() instead of view()
    public $body;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $params)
    {
        $this->params = $params;
        $this->from_name = isset($params['from_name']) ?$params['from_name']: config('mail.from.name');
        $this->from_email = isset($params['from_email']) ? $params['from_email']: config('mail.from.email');

        $this->subject = isset($params['subject']) ? $params['subject']: 'Icheck Notification';
        $this->name = isset($params['name']) ? $params['name']: $params['email'];
        $this->template = $params['template'];
        $this->template_type = isset($params['template_type']) ? $params['template_type'] : 'custom'; // custom | post_reply | answer_reply | subscribe |
        $this->body = isset($params['body']) ? $params['body'] : '';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // all publics are accessable into view.
        // return $this->view('admin.emails.send');

        return $this->subject($this->subject)->from($this->from_email, $this->from_name)->view($this->template);
    }
}
