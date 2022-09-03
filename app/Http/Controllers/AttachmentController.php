<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Http\Requests\StoreAttachmentRequest;
use App\Http\Requests\UpdateAttachmentRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class AttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(Attachment::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAttachmentRequest $request
     * @return JsonResponse
     */
    public function store(StoreAttachmentRequest $request)
    {
        /** @var Attachment $save **/
        $save = Attachment::create([
            "name" => $request->name,
        ]);
        Storage::makeDirectory("public/attachments/$save->id");
        try {
            $path = $request->file('file')->store("public/attachments/$save->id");

            $save->path = $path;
            $save->save();

            return response()->json($save);

        }catch (Exception|ValidationException $exception) {
            Storage::deleteDirectory("public/attachments/$save->id");
            $save->delete();
            return response()->json([
                "message" => $exception->getMessage(),
                "code" => $exception->getCode(),
                "file" => $exception->getFile(),
                "line" => $exception->getLine(),
                "trace" => $exception->getTraceAsString()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Attachment $attachment
     * @return Response
     */
    public function show(Attachment $attachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Attachment $attachment
     * @return Response
     */
    public function edit(Attachment $attachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateAttachmentRequest $request
     * @param Attachment $attachment
     * @return Response
     */
    public function update(UpdateAttachmentRequest $request, Attachment $attachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Attachment $attachment
     * @return Response
     */
    public function destroy(Attachment $attachment)
    {
        //
    }
}
