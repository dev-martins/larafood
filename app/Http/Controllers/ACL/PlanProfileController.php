<?php

namespace App\Http\Controllers\ACL;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateDetailPlan;
use App\Models\DetailPlan;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanProfileController extends Controller
{

    protected $detailPlan;
    protected $plan;

    public function __construct(DetailPlan $detailPlan, Plan $plan)
    {
        $this->detailPlan = $detailPlan;
        $this->plan = $plan;

        // $this->middleware(['can:plans']);
    }

    public function index($urlPlan)
    {
        if (!$plan = $this->plan->where('url', $urlPlan)->first()) {
            return redirect()->back();
        }

        // $details = $plan->details();
        $details = $plan->details()->paginate();

        return view('admin.pages.plans.details.index', [
            'plan' => $plan,
            'details' => $details,
        ]);
    }

    public function create($urlPlan)
    {
        if (!$plan = $this->plan->where('url', $urlPlan)->first()) {
            return redirect()->back();
        }

        return view('admin.pages.plans.details.create', [
            'plan' => $plan,
        ]);
    }

    public function store(StoreUpdateDetailPlan $request, $urlPlan)
    {
        if (!$plan = $this->plan->where('url', $urlPlan)->first()) {
            return redirect()->back();
        }

        // $data = $request->all();
        // $data['plan_id'] = $plan->id;
        // $this->detailPlan->create($data);
        $plan->details()->create($request->all());

        return redirect()->route('details.plan.index', $plan->url);
    }


    public function edit($urlPlan, $idDetail)
    {
        $plan = $this->plan->where('url', $urlPlan)->first();
        $detail = $this->detailPlan->find($idDetail);

        if (!$plan || !$detail) {
            return redirect()->back();
        }

        return view('admin.pages.plans.details.edit', [
            'plan' => $plan,
            'detail' => $detail,
        ]);
    }

    public function update(StoreUpdateDetailPlan $request, $urlPlan, $idDetail)
    {
        $plan = $this->plan->where('url', $urlPlan)->first();
        $detail = $this->detailPlan->find($idDetail);

        if (!$plan || !$detail) {
            return redirect()->back();
        }

        $detail->update($request->all());

        return redirect()->route('details.plan.index', $plan->url);
    }

    public function show($urlPlan, $idDetail)
    {
        $plan = $this->plan->where('url', $urlPlan)->first();
        $detail = $this->detailPlan->find($idDetail);

        if (!$plan || !$detail) {
            return redirect()->back();
        }

        return view('admin.pages.plans.details.show', [
            'plan' => $plan,
            'detail' => $detail,
        ]);
    }


    public function destroy($urlPlan, $idDetail)
    {
        $plan = $this->plan->where('url', $urlPlan)->first();
        $detail = $this->detailPlan->find($idDetail);

        if (!$plan || !$detail) {
            return redirect()->back();
        }

        $detail->delete();

        return redirect()
                    ->route('details.plan.index', $plan->url)
                    ->with('message', 'Registro detalado com sucesso');
    }
}
