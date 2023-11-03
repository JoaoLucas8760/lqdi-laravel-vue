<?php
namespace App\Services;

use App\Contracts\EmailNewsletterContract;
use App\Models\Newsletter;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class NewsletterService
{

    private Newsletter $model;
    private EmailNewsletterContract $dispatcherEmail;

    public function __construct(Newsletter $newsletter, EmailNewsletterContract $dispatcherEmail)
    {
        $this->model = $newsletter;
        $this->dispatcherEmail = $dispatcherEmail;
    }

    /**
     * @param array $params
     * @return mixed
     */
    public function store(array $params): mixed
    {
        try{
            $data = $this->model::create($params);
        }catch(\Exception $exception)
        {
            DB::rollBack();
            throw new \Exception($exception->getMessage());
        }

        $this->dispatcherEmail->dispatcherWelcome([
            'email' => $params['email'],
            'title' => 'Hello ' . $params['name'],
            'body' => 'welcome to LQDI',
            'subject' => 'LQDI says'
        ]);

        return $data;
    }
    /**
     * @return mixed
     */
    public function all(): mixed
    {
        try{
            $users = $this->model::all();
        }catch(\Exception $exception)
        {
            throw new \Exception($exception->getMessage());
        }

        return $users;
    }

}
