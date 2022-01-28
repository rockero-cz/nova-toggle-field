<?php

namespace Rockero\NovaToggleField;

use Illuminate\Routing\Controller;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Http\Requests\ResourceIndexRequest;
use App\Nova\Toggle;

class ToggleFieldController extends Controller
{
    public function __invoke(NovaRequest $request)
    {
        $resource = $request->findResourceOrFail($request->resourceId);

        $resource->authorizeToUpdate($request);

        $indexRequest = ResourceIndexRequest::createFrom(
            tap(clone $request, function (NovaRequest $request) {
                $request->server->set('REQUEST_METHOD', 'GET');
            })
        );

        /** @var Toggle */
        $field = $resource
            ->indexFields($indexRequest)
            ->findFieldByAttribute($request->attribute);

        if ($field->toggleCallback) {
            call_user_func($field->toggleCallback, $request->boolean('value'), $resource, $request);

            return;
        }

        $resource->model()->update([
            $request->attribute => $request->boolean('value'),
        ]);
    }
}