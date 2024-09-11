<?php
namespace App\Services\Api ;

use App\Entity\Tasks;
use App\Mybase\Services\Base\SBase;
use Symfony\Component\HttpFoundation\Request;

class TaskApiService extends SBase
{
    
    // protected $property;

    // public function __construct()
    // {
        
    //     $this->utils = $utils ;

    // }

    public function list(Request $request)
    {

        // $alertLists     = $this->getRepository(Tasks::class)->findBy(['user' => $currentUser]) ;
        $taskLists     = $this->getRepository(Tasks::class)->findAll() ;

        if($taskLists){
            
            $datas = $this->serialize($taskLists, 'json', ["withGroups"=>"tasks:read"]);

            return $this->jsonResponseOk($datas , "List task terminated" ) ;

        }
        
        return $this->jsonResponseNotFound("No result found") ;

    }

    public function add(Request $request)
    {

        $datas          = $this->getPostedData($request) ;

        // $idTheproperty  = $datas['idTheproperty'] ;
        // $comment        = $datas['comment'] ;

        $theproperty    = $this->getRepository(TheProperty::class)->findOneBy(['id' => $idTheproperty]) ;

        if($theproperty){

            $abuse = new Abuse() ;

            $abuse->setCreated(new \DateTime())
                ->setComment($comment)
                ->setTheproperty($theproperty)
                ->setUser($currentUser) ;

            $this->save($abuse) ;

            $datas = $this->serialize($abuse, 'json' , ['groups' => 'syndicdocumentcomment:read' ]);
            
            return $this->jsonResponseOk($datas , "Abuse send to the administrator" ) ;

        }

        return $this->jsonResponseNotFound("No result found") ;

    }

}