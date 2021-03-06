<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Researcher;
use App\Models\ResearcherTeam;
use App\Models\ResearcherWorkshop;
use App\Models\InterestGroup;
use App\Models\Expertise;

class PersonelController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Researcher $personel)
    {

        $this->model = $personel;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {

        $data['model'] = $this->model;
        
        return view('frontend.default.index', $data);
    }

    public function getDetail($id)
    {
        $data['profile'] = $this->model->whereId($id)->first();

        $data['research'] = ResearcherTeam::select('researcher_teams.*')->join('researches', 'researcher_teams.other_id','=','researches.id')->where('researcher_teams.researcher_id', $id)->where('researcher_teams.type','penelitian')->whereNull('researches.deleted_at')->where('researches.status','publish')->get();
        $data['publication'] = ResearcherTeam::select('researcher_teams.*')->join('publications', 'researcher_teams.other_id','=','publications.id')->where('researcher_teams.researcher_id', $id)->where('researcher_teams.type','publikasi')->whereNull('publications.deleted_at')->where('publications.status','publish')->get();
        $data['workshop'] = ResearcherWorkshop::where('researcher_id',$id)->get();

        
		if ($data['profile']->interest_category){
			$expl = explode(',', $data['profile']->interest_category);
			$data['interest'] = InterestGroup::whereIn('id', $expl)->get();
		}
		if ($data['profile']->expert_category){
			$expl = explode(',', $data['profile']->expert_category);
			$data['expert'] = Expertise::whereIn('id', $expl)->get();
		}
        // dd($data);
        // dd($data['research'][0]->research->title);

        return view('frontend.member.profile', $data);
    }

    public function getPortofolio($id)
    {
        $model = $this->model->find($id);
        return view('frontend.member.portofolio', compact('model'));
    }
}
