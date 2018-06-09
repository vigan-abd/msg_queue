<?php
namespace App\Model\Domain;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use \Illuminate\Support\Facades\Validator;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'role', 'username', 'active'];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

	protected $rules =
	[
		'name' => 'required|min:3',
		'username' => 'required|min:3',
		'password' => 'required|min:6',
		'email' => 'required',
	];

	protected $messages =
	[
		'name.required' => 'Emri eshte obligativ',
		'name.min' => 'Emri duhet te permbaje te pakten 3 karaktere',
		'username.required' => 'Username eshte obligativ',
		'username.min' => 'Username duhet te permbaje te pakten 3 karaktere',
		'username.unique' => 'Username ekziston ne sistem',
		'email.required' => 'Email adresa eshte obligative',
		'email.unique' => 'Email adresa ekziston ne sistem',
		'email.email' => 'Formati i email nuk eshte valid',
	];

    /**
	 * @return bool
	 */
    public function validate(&$errors = [], $data = [])
    {
		if (count($data) == 0)
			$data = $this->attributes;
        $v = Validator::make($data, $this->rules, $this->messages);

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

	/**
	 * Checks if the user has role
	 * @param array $role
	 * @return boolean
	 */
	public function hasRole($role)
	{
		$role = explode('|', $role);
        return in_array($this->role,  $role);
	}
	
	public function customer()
	{
		return $this->hasOne('App\Model\Domain\Customer');
	}
	
	public function storeAdmin()
	{
		return $this->hasOne('App\Model\Domain\StoreAdmin');
	}

	public function gameConfig()
	{
		return $this->hasOne('App\Model\Domain\GameUserConfig');
	}
}
