<?php

namespace App\Controller;

use App\DTO\LowestPriceEquiry;
use App\Filter\PromotionsFilterInterface;
use App\Service\Serializer\DTOSerializer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{


    #[Route('/products/{id}/promotions', name: 'promotions', methods:'GET')]
    public function promotions()
    {

    }




    #[Route('/products/{id}/lowest-price', name: 'lowest-price', methods:'POST')]
    public function lowestPrice(Request $request, int $id, DTOSerializer $serializer, PromotionsFilterInterface $promotionsFilter): Response
    {

        if ($request->headers->has('force_fail')) {
            return new JsonResponse(
                ['error' => 'Promotions Engine Failure message'],
                $request->headers->get('force_fail')
            ); 
        }

        //1. Desirialize json data into DTO(data transfer object) EnquiryDTO
        /**
         * @var LowestPriceEquiry $lowestPriceEquiry
         */
        $lowestPriceEquiry = $serializer->deserialize($request->getContent(), LowestPriceEquiry::class, 'json');
        // dd($lowestPriceEquiry);
        //2. pass the Enquiry into a promotions filter
            //the appropriate promotion will be applied
        //#. return modified Enquiry

        $modifiedEnquiry = $promotionsFilter->apply($lowestPriceEquiry);
       


        $responseContent =$serializer->serialize($modifiedEnquiry, 'json');

        return new Response($responseContent, Response::HTTP_OK);

        // return new JsonResponse($lowestPriceEquiry);
        
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
