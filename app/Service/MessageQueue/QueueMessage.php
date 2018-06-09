<?php
namespace App\Service\MessageQueue;

use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Support\Facades\Validator;

/**
 * Payload model that will be stored on db
 * 
 * @version 1.0.0
 * @author vigan.abd <vigan.abd@gmail.com>
 */
class QueueMessage extends Model
{
    protected $table = 'message_queue';
    
	protected $fillable = ['queue', 'message'];

	protected $rules =
	[
		'queue' => 'required',
		'message' => 'required'
    ];

    /**
	 * @return bool
	 */
    public function validate(&$errors = [])
    {
        $v = Validator::make($this->attributes, $this->rules, $this->messages);
        if ($v->passes())
		{
			$errors = [];
			return true;
		}
		else
		{
			$errors = $v->errors()->toArray();
			return false;
		}
	}
}
?>