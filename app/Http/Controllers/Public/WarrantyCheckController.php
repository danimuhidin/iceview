<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\WarrantyCheckRequest;
use App\Models\Warranty;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class WarrantyCheckController extends Controller
{
    public function index(): View
    {
        return view('public.warranty.check');
    }

    public function check(WarrantyCheckRequest $request): View|RedirectResponse
    {
        $search = strtoupper(trim((string) $request->validated()['search']));

        $warranty = Warranty::query()->whereRaw('UPPER(warranty_code) = ?', [$search])->first();

        if (! $warranty) {
            $warranty = Warranty::query()->whereRaw('UPPER(engine_number) = ?', [$search])->first();
        }

        if (! $warranty) {
            return back()->withErrors([
                'search' => 'Data garansi tidak ditemukan.',
            ])->withInput();
        }

        $engineNumber = $warranty->engine_number;

        return view('public.warranty.result', [
            'search' => $search,
            'engineNumber' => $engineNumber,
            'primaryWarranty' => $warranty->load(['dealer', 'items']),
            'warranties' => Warranty::query()
                ->with(['dealer', 'items'])
                ->where('engine_number', $engineNumber)
                ->latest()
                ->get(),
        ]);
    }
}