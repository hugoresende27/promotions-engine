<?php

namespace App\Controller;

use App\Cache\PromotionCache;
use App\DTO\LowestPriceEnquiry;
use App\Filter\LowestPriceFilter;
use App\Repository\ProductRepository;
use App\Service\Serializer\DTOSerializer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class ProductController extends AbstractController
{

    /** php < 8 */
    // private ProductRepository $repository;
    // private EntityManager $entityManager;
    public function __construct(
        private ProductRepository $repository, //php >= 8
        private EntityManagerInterface $entityManager,
        private PromotionCache $promotionCache,
        )
    {
        // $this->repository = $repository;
        // $this->entityManager = $entityManager;
    }


    #[Route('/products/{id}/promotions', name: 'promotions', methods:'GET')]
    public function promotions()
    {

    }




    #[Route('/products/{id}/lowest-price', name: 'lowest-price', methods:'POST')]
    public function lowestPrice(Request $request, int $id, DTOSerializer $serializer, LowestPriceFilter $promotionsFilter): Response
    {

        if ($request->headers->has('force_fail')) {
            return new JsonResponse(
                ['error' => 'Promotions Engine Failure message'],
                $request->headers->get('force_fail')
            ); 
        }

        //1. Desirialize json data into DTO(data transfer object) EnquiryDTO
        /**
         * @var LowestPriceEnquiry $lowestPriceEnquiry
         */
        $lowestPriceEnquiry = $serializer->deserialize(
            $request->getContent(), 
            LowestPriceEnquiry::class,
             'json');
        // dd($lowestPriceEnquiry);


     
        $product = $this->repository->find($id); //add error handling for not found product
        

        //2. pass the Enquiry into a promotions filter
        //the appropriate promotion will be applied
        //#. return modified Enquiry
        $lowestPriceEnquiry->setProduct($product);

        $promotions = $this->promotionCache->findValidForProduct($product, $lowestPriceEnquiry->getRequestDate());


        $modifiedEnquiry = $promotionsFilter->apply($lowestPriceEnquiry, ...$promotions);

        // dd($modifiedEnquiry);
        $responseContent =$serializer->serialize($modifiedEnquiry, 'json');

        return new Response($responseContent, Response::HTTP_OK, ['Content-Type'=> 'application/json']);

        // return new JsonResponse($lowestPriceEnquiry);
        
        // return new JsonResponse([
        //     'quantity' => 5,
        //     "request_location" => "UK",
        //     "voucher_code" => "AAA",
        //     "request_date" => "2024-10-10",
        //     "product_id" => $id,
        //     'price' => 100,
        //     'discounted_price' => 50,
        //     'promotion_id' => 3,
        //     'promotion_name' => 'Black Friday half price sale'
        // ], 200);
    }
}
