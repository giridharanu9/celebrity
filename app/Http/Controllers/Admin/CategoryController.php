<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Category;
use DB;

class CategoryController extends Controller
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
        return view('admin.category.list');
    }

    public function listDatatable(REQUEST $request){
        $requestData= $_REQUEST;

        $columns = array('id', 'categorytitle');
        $sql = "select * from categories";
        $resultData = DB::select($sql);
        $totalData = count($resultData);
        // if there is no search parameter then total number rows = total number filtered rows.
        $totalFiltered = $totalData;  


        $sql = "select * from categories";
        
        if( !empty($requestData['search']['value']) ) {   
            $sql.=" WHERE ( id LIKE '%".$requestData['search']['value']."%' ";    
            $sql.=" OR categorytitle LIKE '%".$requestData['search']['value']."%' ) ";
        }
        $resultData = DB::select($sql);
        //if there is a search parameter then modify total number filtered rows as per search result. 
        $totalFiltered = count($resultData);

        $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
        $resultData = DB::select($sql);

        $data = array();
        if(count($resultData) > 0){
            foreach($resultData as $row){
                $edit_url = route('category.edit', $row->id);
                $nestedData=array();
                
                $nestedData[] = $row->id;
                $nestedData[] = ucfirst($row->categorytitle);
                if($row->status == 1){
                    $nestedData[] = '<div class="statusBtn'.$row->id.'"><a href="javascript:void(0);" onclick="changeStatus(\''.$row->id.'\', \'0\')" class="btn btn-success btn-sm" title="Click here to make it inactive">Active</a></div>';
                }else{
                    $nestedData[] = '<div class="statusBtn'.$row->id.'"><a href="javascript:void(0);" onclick="changeStatus(\''.$row->id.'\', \'1\')" class="btn btn-danger btn-sm" title="Click here to make it active" >Inactive</a></div>';
                }
                
                $nestedData[] = '<a class="btn btn-info btn-sm" href="'.$edit_url.'"><i class="fa fa-edit"></i></a>';
                
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
        $pollid = $request->get('id');
        $newstatus = $request->get('newstatus');

        $update = Category::where('id', $pollid)->update(['status' => $newstatus]);
        return $update;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
        $input = request()->validate(['categoryname' => 'required|max:225|min:2']);

        $category = new Category;
        $category->categorytitle = $request->input('categoryname');
        $categorySaved = $category->save();

        if($categorySaved){
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Category have been created successfully!');
        }else{
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'Error Occurred!');
        }
        
        return redirect()->route('category.index');
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
        $categoryData = Category::where('id', $id)-> first();
        return view('admin.category.edit', ['categoryData' => $categoryData]);
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
        $input = request()->validate(['categoryname' => 'required|max:225|min:2']);
        $categoryname = $request->get('categoryname');
        
        $categoryUpdate = Category::where('id', $id)->update(['categorytitle' => $categoryname]);


        if($categoryUpdate){
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Category details have been updated successfully!');
        }else{ 
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'Error Occurred!');
        }
        
        return redirect()->route('category.index');
    }

}
