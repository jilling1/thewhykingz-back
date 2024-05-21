<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewsItemRequest;
use App\Http\Requests\UpdateNewsItemRequest;
use App\Models\NewsItem;
use App\Interfaces\NewsItemRepositoryInterface;
use App\Classes\ApiResponseClass;
use App\Http\Resources\NewsItemResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class NewsItemController extends Controller
{

    private NewsItemRepositoryInterface $newsItemRepositoryInterface;

    public function __construct(NewsItemRepositoryInterface $newsItemRepositoryInterface)
    {
        $this->newsItemRepositoryInterface = $newsItemRepositoryInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->newsItemRepositoryInterface->index();

        return ApiResponseClass::sendResponse(NewsItemResource::collection($data),'',200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNewsItemRequest $request)
    {
        $details =[
            'title' => $request->title,
            'short_description' => $request->short_description,
            'full_description' => $request->full_description,
            'status' => $request->status
        ];
        DB::beginTransaction();
        try{
             $newsItem = $this->newsItemRepositoryInterface->store($details);

             DB::commit();
             return ApiResponseClass::sendResponse(new NewsItemResource($newsItem),'News Create Successful',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $newsItem = $this->newsItemRepositoryInterface->getById($id);

        return ApiResponseClass::sendResponse(new NewsItemResource($newsItem),'',200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NewsItem $newsItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNewsItemRequest $request, $id)
    {
        $updateDetails =[
            'title' => $request->title,
            'short_description' => $request->short_description,
            'full_description' => $request->full_description,
            'status' => $request->status
        ];
        DB::beginTransaction();
        try{
             $product = $this->newsItemRepositoryInterface->update($updateDetails,$id);

             DB::commit();
             return ApiResponseClass::sendResponse('News Update Successful','',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->newsItemRepositoryInterface->delete($id);

        return ApiResponseClass::sendResponse('News Delete Successful','',204);
    }

    public function changeStatus (Request $request, $id) {
        DB::beginTransaction();
        try{
             $this->newsItemRepositoryInterface->changeStatus($request->status,$id);
             $newsItem = $this->newsItemRepositoryInterface->getById($id);

             DB::commit();
             return ApiResponseClass::sendResponse(new NewsItemResource($newsItem),'',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }
    }
}
