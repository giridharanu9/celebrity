<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\AdminPollRequest;
use App\Http\Controllers\Controller;

use App\Poll;
use App\PollOptions;
use DB;
class PollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $sql = "select *, (select GROUP_CONCAT(poll_option) from poll_options where poll_id=polls.id ) as polloptions from polls where isdelete = 0";
        $pollsData = DB::select($sql);
        
        return view('admin.poll.list')->with('polldata', $pollsData);
    }

    public function listDatatable(REQUEST $request){
        $requestData= $_REQUEST;

        $columns = array('poll_subject', 'poll_options', 'username', 'email');
        $sql = "select *, (select GROUP_CONCAT(poll_option) from poll_options where poll_id=polls.id ) as poll_options from polls where isdelete = 0";
        $pollsData = DB::select($sql);
        $totalData = count($pollsData);
        // if there is no search parameter then total number rows = total number filtered rows.
        $totalFiltered = $totalData;  


        $sql = "select *, (select GROUP_CONCAT(poll_option) from poll_options where poll_id=polls.id ) as poll_options from polls where isdelete = 0";
        
        if( !empty($requestData['search']['value']) ) {   
            $sql.=" AND ( poll_subject LIKE '%".$requestData['search']['value']."%' ";    
            $sql.=" OR (select GROUP_CONCAT(poll_option) from poll_options where poll_id=polls.id ) LIKE '%".$requestData['search']['value']."%' ) ";
        }
        $pollsData = DB::select($sql);
        //if there is a search parameter then modify total number filtered rows as per search result. 
        $totalFiltered = count($pollsData); 

        $sql.=" ORDER BY ". $columns[0]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
        $pollsData = DB::select($sql);

        $data = array();
        if(count($pollsData) > 0){
            foreach($pollsData as $row){
                $edit_url = route('poll.edit', $row->id);
                $nestedData=array();
                
                $nestedData[] = $row->poll_subject;
                $nestedData[] = $row->poll_options;
                if($row->isactive == 1){
                    $nestedData[] = '<div class="statusBtn'.$row->id.'"><a href="javascript:void(0);" onclick="changeStatus(\''.$row->id.'\', \'0\')" class="btn btn-success btn-sm" title="Click here to make it inactive">Active</a></div>';
                }else{
                    $nestedData[] = '<div class="statusBtn'.$row->id.'"><a href="javascript:void(0);" onclick="changeStatus(\''.$row->id.'\', \'1\')" class="btn btn-danger btn-sm" title="Click here to make it active" >Inactive</a></div>';
                }
                
                $nestedData[] = '<a class="btn btn-info btn-sm" href="'.$edit_url.'"><i class="fa fa-edit"></i></a>
                        <a class="btn btn-danger btn-sm" href="javascript:void(0);" onclick="deleteRecord(\''.$row->id.'\')"><i class="fa fa-remove"></i></a>';
                
                $data[] = $nestedData;
            }
        }
        
        $json_data = array(
                    "draw"            => intval( $requestData['draw'] ),
                    "recordsTotal"    => intval( $totalData ),
                    "recordsFiltered" => intval( $totalFiltered ),
                    "data"            => $data
                    );

        return json_encode($json_data);  // send data as json format
    }

    public function changestatus(REQUEST $request){
        $pollid = $request->get('pollid');
        $newstatus = $request->get('newstatus');

        $update = Poll::where('id', $pollid)->update(['isactive' => $newstatus]);
        return $update;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.poll.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //public function store(AdminPollRequest $request)
    public function store(Request $request)
    {
        /*$request->validate([
            'subject' => 'required|max:2',
            'option1' => 'required|max:2',
            'option2' => 'required|max:2',
            'option3' => 'required|max:2',
            'option4' => 'required|max:2'
        ]);*/
        //with custom msg validation
        $input = request()->validate([
            'subject' => 'required|max:225|min:2',
            'option1' => 'required|max:125|min:2',
            'option2' => 'required|max:125|min:2',
            'option3' => 'required|max:125|min:2',
            'option4' => 'required|max:125|min:2'
            ], [
                //'subject.min' => 'Poll subject is required field min value 2.',
               /* 'subject.required' => 'Poll subject is required field.',
                'option1.required' => 'First option must have text.',
                'option2.required' => 'Second option must have some text',
                'option3.required' => 'Third option must have some text',
                'option4.required' => 'Fourth option must have some text',*/
            ]);

        $poll = new Poll;
        $polloptions = new PollOptions;

        $poll->poll_subject = $request->input('subject');
        $poll->poll_status =  1;
        $poll->created_at =  time();
        $poll->updated_at =  time();
        $pollSaved = $poll->save();

        $lastPollInsertedId = $poll->id;

        $data = array(
            array('poll_id'=>$lastPollInsertedId, 'poll_option'=> $request->input('option1')),
            array('poll_id'=>$lastPollInsertedId, 'poll_option'=> $request->input('option2')),
            array('poll_id'=>$lastPollInsertedId, 'poll_option'=> $request->input('option3')),
            array('poll_id'=>$lastPollInsertedId, 'poll_option'=> $request->input('option4'))
        );
        $pollOptionsSaved = PollOptions::insert($data);

        if($pollSaved && $pollOptionsSaved){
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Poll have been created successfully!');
        }else{
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'Error Occurred!');
        }
        
        return redirect()->route('poll.create');
        
        /*$test = Poll::all();
        $test = Poll::get()->count();
        $test = PollOptions::get()->count();
        print_r($test);die();
        echo '<pre>'; print_r($_REQUEST);die();*/
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return 'show details';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pollData = Poll::where('id', $id)-> first();
        $pollOptions = PollOptions::where('poll_id', $id)->get();
        
        return view('admin.poll.edit', ['polldata' => $pollData, 'polloptions'=>$pollOptions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //return 'in update details';
        $subject = $request->get('subject');
        $polloption1 = $request->get('option1');
        $polloption1Id = $request->get('option1_dbId');

        $polloption2 = $request->get('option2');
        $polloption2Id = $request->get('option2_dbId');

        $polloption3 = $request->get('option3');
        $polloption3Id = $request->get('option3_dbId');

        $polloption4 = $request->get('option4');
        $polloption4Id = $request->get('option4_dbId');

        $pollUpdate = Poll::where('id', $id)->update(['poll_subject' => $subject]);

        $pollOption1Update = PollOptions::where('poll_id', $id)->where('id', $polloption1Id)->update(['poll_option' => $polloption1]);
        $pollOption2Update = PollOptions::where('poll_id', $id)->where('id', $polloption2Id)->update(['poll_option' => $polloption2]);
        $pollOption3Update = PollOptions::where('poll_id', $id)->where('id', $polloption3Id)->update(['poll_option' => $polloption3]);
        $pollOption4Update = PollOptions::where('poll_id', $id)->where('id', $polloption4Id)->update(['poll_option' => $polloption4]);

        if($pollUpdate){
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Poll details have been updated successfully!');
        }else{ 
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'Error Occurred!');
        }
        
        return redirect()->route('poll.edit', array('id' => $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pollUpdate = Poll::where('id', $id)->update(['isdelete' => 1]);
        $data = [];
        if($pollUpdate){
            $data = array('status' => 'success', 'msg' => 'Poll record have been deleted successfully!');
        }else{
            $data = array('status' => 'error', 'msg' => 'Error Occurred!');
        }
        return response()->json($data);
    }
}
