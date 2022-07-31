<?php

namespace drafeef\base\Http\Controllers;


use drafeef\base\Foundation\Log;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use drafeef\base\Foundation\ResponseTemplate;
use drafeef\base\Http\Requests\UploadPhotoRequest;

class IndexController extends BaseController {

    /**
     * @return JsonResponse
     * ||************************* API Reference *********************************||
     * @uses  This api for upload photo and retrieve photo name
     * @author Anas almasri (anas.almasri@merwas.net)
     * @version V1
     * @endpoint {{base_url}}/api/common/{{version}}/upload_photo
     * @method POST
     * ||************************* API Reference *********************************||
     */
    public function uploadPhoto(UploadPhotoRequest $request):JsonResponse
    {
        try {
            $data = $request->only(['photo']);
            $path = $data['photo']->store('public');
            $storage_name = basename($path);

            return ResponseTemplate::success(
                Response::HTTP_OK,
                trans('base::response.The_photo_has_been_uploaded_successfully'),
                ['photo_name'=>$storage_name]
            );

        } catch (\Exception $exception) {

            log::errorLog(
                FALSE,
                $exception->getFile() ,
                $exception->getLine() ,
                $exception->getMessage() ,
                __CLASS__ . '--' . __FUNCTION__
            );

            return ResponseTemplate::exceptionError(
                trans('base::response.process_failed'),
            );
        }
    }

}
