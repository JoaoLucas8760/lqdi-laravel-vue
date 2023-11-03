<?php

namespace App\Http\Controllers;

use App\Services\NewsletterService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Validates\NewsletterValidate;
use Illuminate\Contracts\View\View;

class NewsletterController extends Controller
{

    private NewsletterService $newsletterService;
    private NewsletterValidate $newsletterValidate;

    public function __construct(
        NewsletterService $newsletterService,
        NewsletterValidate $newsletterValidate
    )
    {
        $this->newsletterService = $newsletterService;
        $this->newsletterValidate = $newsletterValidate;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $this->newsletterValidate::store($request);

        try{
             $data = $this->newsletterService->store($request->all());
        }catch(\Exception $e){
            return response()->json($e->getMessage(), 400);
        }

        return response()->json($data, 201);
    }

    /**
     * @return View
     */
    public function listAll(): View
    {
        try{
            $users = $this->newsletterService->all();
        }catch(\Exception $e){
            view('admin.users')->with('error', $e->getMessage());
        }

        return view('admin.users')->with('users', $users);
    }
}
