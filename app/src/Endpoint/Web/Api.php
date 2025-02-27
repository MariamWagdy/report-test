<?php

declare(strict_types=1);

namespace App\Endpoint\Web;

use App\Domain\Report\Repository\ReportRepositoryInterface;
use App\Entity\Order;
use Cycle\ORM\ORMInterface;
use Spiral\Http\ResponseWrapper;
use Spiral\Router\Annotation\Route;
use Psr\Http\Message\ResponseInterface;
use Spiral\Http\Request\InputManager;

final class Api
{
    private ResponseWrapper $response;
    protected ReportRepositoryInterface $reportRepository;

    public function __construct(ResponseWrapper $response, ReportRepositoryInterface $reportRepository)
    {
        $this->response = $response;
        $this->reportRepository = $reportRepository;
    }

    #[Route(route: '/show-orders', name: 'show-orders', methods: 'GET')]
    public function showOrders(ORMInterface $orm): ResponseInterface
    {
        try {
            $repository = $orm->getRepository(Order::class);

            $orders = $repository->findAll();
            $data = array_map(fn(Order $order) => $order->toArray(), $orders);

            return $this->response->json(['data' => $data]);
        } catch (\Throwable $e) {
            return $this->response->json(['data' => [
                'status' => 'error',
                'message' => $e->getMessage(),
            ]]);
        }
    }

    #[Route(route: '/monthly-sales-by-region', name: 'getMonthlySalesByRegion', methods: ['GET'])]
    public function getMonthlySalesByRegion(): ResponseInterface
    {
        try {
            $monthlySalesByRegion = $this->reportRepository->getMonthlySalesByRegion();

            return $this->response->json(['data' => $monthlySalesByRegion]);
        } catch (\Throwable $e) {
            return $this->response->json(['data' => [
                'status' => 'error',
                'message' => $e->getMessage(),
            ]]);
        }
    }


    #[Route(route: '/top-categories-by-store', name: 'getTopCategoriesByStore', methods: 'GET')]
    public function getTopCategoriesByStore(InputManager $input): ResponseInterface
    {
        try {
            $startDate = $input->query('start_date');
            $endDate = $input->query('end_date');

            if (!$startDate || !$endDate) {
                return $this->response->json([
                    'status' => 'error',
                    'message' => 'Both start_date and end_date are required parameters.'
                ], 400);
            }
            if (!preg_match('/\d{4}-\d{2}-\d{2}/', $startDate) || !preg_match('/\d{4}-\d{2}-\d{2}/', $endDate)) {
                return $this->response->json(['error' => 'Invalid date format. Use YYYY-MM-DD.'], 400);
            }
            $topCategoriesByStore = $this->reportRepository->getTopCategoriesByStore($startDate, $endDate);

            return $this->response->json(['data' => $topCategoriesByStore]);
        } catch (\Throwable $e) {
            return $this->response->json(['data' => [
                'status' => 'error',
                'message' => $e->getMessage(),
            ]]);
        }
    }
}
