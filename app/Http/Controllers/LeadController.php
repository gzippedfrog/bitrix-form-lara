<?php

namespace App\Http\Controllers;

use App\Events\LeadNotCreated;
use App\Http\Requests\StoreLeadRequest;
use App\Models\Lead;
use Illuminate\Http\Client\Pool;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class LeadController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('lead.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreLeadRequest $request
     * @return RedirectResponse
     */
    public function store(StoreLeadRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $params = [
            'FIELDS[NAME]' => $validated['first_name'],
            'FIELDS[SECOND_NAME]' => $validated['second_name'],
            'FIELDS[LAST_NAME]' => $validated['last_name'],
            'FIELDS[EMAIL][0][VALUE]' => $validated['email'],
            'FIELDS[EMAIL][0][VALUE_TYPE]' => 'WORK',
            'FIELDS[PHONE][0][VALUE]' => $validated['phone'],
            'FIELDS[PHONE][0][VALUE_TYPE]' => 'WORK',
            'FIELDS[BIRTHDATE]' => $validated['birthdate']->format('d.m.Y'),
            'FIELDS[COMMENTS]' => $validated['message'],
        ];

        $responses = Http::pool(fn(Pool $pool) => [
            $pool->as('contact_id')->get("{$_ENV['BITRIX_WEBHOOK_URL']}/crm.contact.add", $params),
            $pool->as('lead_id')->get("{$_ENV['BITRIX_WEBHOOK_URL']}/crm.lead.add"),
        ]);

        $responses = array_map(fn($response) => json_decode($response), $responses);

        foreach ($responses as $response) {
            if (!empty($response->error)) {
                LeadNotCreated::dispatch($validated, $response);
                return redirect(route('error'));
            }
        }

        $response = json_decode(
            Http::get("{$_ENV['BITRIX_WEBHOOK_URL']}/crm.lead.contact.add", [
                'id' => $responses['lead_id']->result,
                'FIELDS[CONTACT_ID]' => $responses['contact_id']->result,
            ])->body());

        if (!empty($response->error)) {
            LeadNotCreated::dispatch($validated, $response);
            return redirect(route('error'));
        }

        $lead = new Lead($validated);
        $lead->bitrix_id = $responses['lead_id']->result;
        $lead->save();

        return redirect(route('success'));
    }
}
