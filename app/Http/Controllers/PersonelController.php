<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Researcher;
use App\Models\ResearcherTeam;

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
        $data['research'] = ResearcherTeam::select('researcher_teams.*')->join('researches', 'researcher_teams.other_id','=','researches.id')->where('researcher_teams.researcher_id', $id)->where('researcher_teams.type','penelitian')->whereNull('researches.deleted_at')->get();
        $data['publication'] = ResearcherTeam::select('researcher_teams.*')->join('publications', 'researcher_teams.other_id','=','publications.id')->where('researcher_teams.researcher_id', $id)->where('researcher_teams.type','publikasi')->whereNull('publications.deleted_at')->get();
        
        // dd($data);
        // dd($data['research'][0]->research->title);

        return view('frontend.member.profile', $data);
    }
}
