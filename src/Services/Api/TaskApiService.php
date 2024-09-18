<?php
namespace App\Services\Api ;

use App\Entity\Tasks;
use App\Mybase\Services\Base\SBase;
use Symfony\Component\HttpFoundation\Request;

class TaskApiService extends SBase
{

    public function list(Request $request)
    {

        $keySearch = $request->query->get("key") ?  $request->query->get("key") : null;

        if ($keySearch == null) {
            # code...
            $taskLists     = $this->getRepository(Tasks::class)->findBy([] , ['status'=>'DESC']) ;

        }else {
            # code...
            // $taskLists     = $this->getRepository(Tasks::class)->findBy([] , ['status'=>'DESC']) ;
            $taskLists     = $this->getRepository(Tasks::class)->findSearch($keySearch) ;

        }

        if($taskLists){
            
            $datas = $this->serialize($taskLists, 'json', ["withGroups"=>"tasks:read"]);

            return $this->jsonResponseOk($datas , "List task terminated" ) ;

        }
        
        return $this->jsonResponseNotFound("No result found") ;

    }

    public function add(Request $request)
    {

        $datas          = $this->getPostedData($request) ;

        $idTask  = isset($datas['idTask']) ? $datas['idTask'] : null ;

        if ($idTask != null) {
            # code...
            $task    = $this->getRepository(Tasks::class)->findOneBy(['id' => $idTask]) ;

            if($task){

                $task
                    ->setUpdated(new \DateTime())
                    ->setTitle($datas['title'])
                    ->setDescription($datas['description'])
                    ->setStatus(intval($datas['status']))  ;

            }else {
                # code...
                return $this->jsonResponseNotFound("No result found") ;
            }

        }else {
            # code...
            $task = new Tasks() ;

            $task
                ->setCreated(new \DateTime())
                ->setTitle($datas['title'])
                ->setDescription($datas['description'])
                ->setStatus(intval($datas['status']))  ;

        }

            $this->save($task) ;

            $datas = $this->serialize($task, 'json' , ["withGroups"=>"tasks:read"]);
            
            return $this->jsonResponseOk($datas , "Succes changing information task" ) ;

    }

    
    // public function search(Request $request)
    // {

    //     $taskLists     = $this->getRepository(Tasks::class)->findBy([] , ['status'=>'DESC']) ;

    //     if($taskLists){
            
    //         $datas = $this->serialize($taskLists, 'json', ["withGroups"=>"tasks:read"]);

    //         return $this->jsonResponseOk($datas , "List task terminated" ) ;

    //     }
        
    //     return $this->jsonResponseNotFound("No result found") ;

    // }

}