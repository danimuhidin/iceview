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

        return redirect()->route('warranty.show', ['warranty_code' => $warranty->warranty_code]);
    }

    public function show(string $warranty_code): View|RedirectResponse
    {
        $warranty = Warranty::query()->whereRaw('UPPER(warranty_code) = ?', [strtoupper($warranty_code)])->first();

        if (! $warranty) {
            return redirect()->route('waranty')->withErrors([
                'search' => 'Data garansi tidak ditemukan.',
            ]);
        }

        $engineNumber = $warranty->engine_number;

        return view('public.warranty.result', [
            'search' => $warranty_code,
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