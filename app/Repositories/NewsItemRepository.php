<?php

namespace App\Repositories;
use App\Models\NewsItem;
use App\Interfaces\NewsItemRepositoryInterface;
class NewsItemRepository implements NewsItemRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function index(){
        return NewsItem::where('status', 'active')->get(['id', 'title', 'short_description', 'status', 'created_at']);
    }

    public function getById($id){
       return NewsItem::findOrFail($id);
    }

    public function store(array $data){
       return NewsItem::create($data);
    }

    public function update(array $data,$id){
       return NewsItem::whereId($id)->update($data);
    }

    public function delete($id){
        NewsItem::destroy($id);
    }

    public function changeStatus ($status, $id) {
       return NewsItem::whereId($id)->update(['status' => $status]);
    }


}
