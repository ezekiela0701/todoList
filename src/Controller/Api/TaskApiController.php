<?php

namespace App\Controller\Api;

use App\Services\Api\TaskApiService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/api/task', name: 'api.task.')]
class TaskApiController extends AbstractController
{
    
    protected $taskApiService;

    public function __construct(TaskApiService $taskApiService)
    {
        
        $this->taskApiService = $taskApiService ;

    }

    #[Route('/list', name: 'list')]
    public function index(Request $request): Response
    {

        return $this->taskApiService->list($request) ; 

    }
    
    #[Route('/add', name: 'add')]
    public function add(Request $request): Response
    {

        return $this->taskApiService->add($request) ; 
    }

    // #[Route('/search', name: 'search')]
    // public function search(Request $request): Response
    // {

    //     return $this->taskApiService->add($request) ; 
    // }

}
