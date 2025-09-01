<?php

namespace Amplify\System\Api\Http\Controllers;

use Amplify\System\Api\Http\Resources\ContactResource;
use App\Models\Contact;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;

class ContactFindController extends Controller
{
    public function __invoke(string $contact_code): ContactResource|JsonResponse
    {
        if (config('amplify.api.contact_detail', false)) {
            $searchColumn = config('amplify.api.contact_id_key', 'id');

            $contact = Contact::where($searchColumn, '=', $contact_code)->first();

            if ($contact) {
                return new ContactResource($contact);
            } else {
                return response()->json(['data' => []], Response::HTTP_NOT_FOUND);
            }
        }

        return response()->json(['data' => []], Response::HTTP_FORBIDDEN);
    }
}
