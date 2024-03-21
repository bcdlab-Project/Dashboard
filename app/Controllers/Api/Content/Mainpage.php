<?php

namespace App\Controllers\Api\Content;

use CodeIgniter\Controller;
use CodeIgniter\API\ResponseTrait;

class Mainpage extends Controller
{
    use ResponseTrait;
    
    public function getIndex() {
        return $this->setResponseFormat('json')->respond(['ok'=>false],400);
    }

    public function getCarousel() {
        $request = service('request');

        $currentId = $request->getGet('currentId');
        $action = $request->getGet('action');

        $model = new \App\Models\ContentCarouselMainPageModel();
        $first_slide = $model->orderBy('id', 'ASC')->first();
        $last_slide = $model->orderBy('id', 'DESC')->first();

        switch ($action) {
            case 'get':
                break;
            case 'next':
                $currentId++;
                break;
            case 'prev':
                $currentId--;
                break;
            default:
                return $this->setResponseFormat('json')->respond(['ok'=>false],400);
        }

        if ($currentId > $last_slide['id']) {
            $currentId = $first_slide['id'];
        } else if ($currentId < $first_slide['id']) {
            $currentId = $last_slide['id'];
        }

        $slide2 = $model->where('id', $currentId)->first();


        if ($currentId == $first_slide['id']) {
            $slide1 = $last_slide;
            $slide3 = $model->where('id >', $currentId)->orderBy('id', 'ASC')->first();
        } else if ($currentId == $last_slide['id']) {
            $slide1 = $model->where('id <', $currentId)->orderBy('id', 'DESC')->first();
            $slide3 = $first_slide;
        } else {
            $slide1 = $model->where('id <', $currentId)->orderBy('id', 'DESC')->first();
            $slide3 = $model->where('id >', $currentId)->orderBy('id', 'ASC')->first();
        }

        return $this->setResponseFormat('json')->respond(['ok'=>true, 'slides'=>[$slide1, $slide2, $slide3]],200);
    }
}