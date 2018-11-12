<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Page;
use App\Category;
use App\Skill;
use DB;
use Illuminate\Support\Str;
use App\RatingQuestion;
use App\Ratings;
use Log;
use Image;
use Response;
class PageController extends Controller
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
        return view('admin.page.list');
    }

    public function listDatatable(REQUEST $request){
       // dd('ashish');
        $requestData= $_REQUEST;

        $categoriesArr = [];
        /*$categories = Category::where('status', 1)->get();
        foreach ($categories as $row) {
            $categoriesArr[$row['id']] = $row['categorytitle'];
        }*/

        $columns = array('id', 'name');
        $sql = "select pages.* from pages";
        $resultData = DB::select($sql);
        $totalData = count($resultData);
        // if there is no search parameter then total number rows = total number filtered rows.
        $totalFiltered = $totalData;


        $sql = "select pages.* from pages";

        if( !empty($requestData['search']['value']) ) {
            $sql.=" WHERE ( pages.id LIKE '%".$requestData['search']['value']."%' ";
            $sql.=" OR name LIKE '%".$requestData['search']['value']."%'  ";
            $sql.=" OR pages.description LIKE '%".$requestData['search']['value']."%' ) ";
        }
        $resultData = DB::select($sql);
        //if there is a search parameter then modify total number filtered rows as per search result.
        $totalFiltered = count($resultData);

        $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
        $resultData = DB::select($sql);

        $data = array();
        if(count($resultData) > 0){
            foreach($resultData as $row){
                $edit_url = route('page.edit', $row->id);
                $delete_url = route('page.delete', $row->id);
                $nestedData=array();

                $nestedData[] = $row->id;
                $nestedData[] = ucfirst($row->name);
               // $nestedData[] = $categoriesArr[$row->categoryid];
                $nestedData[] = '<a class="btn btn-info btn-sm" href="'.$edit_url.'"><i class="fa fa-edit"></i></a>
                    <a class="btn btn-info btn-sm" data-method="delete" href="'.$delete_url.'"><i class="fa fa-trash"></i></a>
                ';

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
        $id = $request->get('id');
        $newstatus = $request->get('newstatus');

        $update = Celebrity::where('id', $id)->update(['status' => $newstatus]);
        return $update;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('status', 1)
        ->where('category_parent', 0)
        ->get();
        $skills = Skill::where('status', 1)->get();
        return view('admin.page.create')->with(['categoryData' => $categories, 'skillsData' => $skills]);
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
        //dd( $request->all());
        $input = request()->validate([
                'name' => 'required|max:225|min:2',
            ]);

        $getuniqueurl = $this->getEventSlug($request->get('name'));

        $page = new Page;
        $page->name = $request->get('name');
        $page->description = $request->get('descr');
        $page->uniqueurl = $getuniqueurl;
        $today = date("Y-m-d");
        //$diff = date_diff(date_create($dateOfBirth), date_create($today));
        $pageSave = $page->save();

        $lastInsertedId = $page->id;


        if($lastInsertedId){
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Page details have been added successfully!');
        }else{
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'Error Occurred!');
        }

        return redirect()->route('page.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
       // dd('sup');
        Page::find($id)->delete();
        return view('admin.page.list');
    }

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
        $pageData = page::where('id', $id)-> first();
        return view('admin.page.edit', ['pageData' => $pageData]);
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
        $input = request()->validate([
                'name' => 'required|max:225|min:2',
            ]);
        $getuniqueurl = $this->getEventSlug($request->get('name'));
        $updateArr = [
            'name' => $request->get('name'),
            'description' => $request->get('descr'),
            'uniqueurl' => $getuniqueurl,
        ];

        $pageUpdate = Page::where('id', $id)->update($updateArr);

        if($pageUpdate){
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Page details have been updated successfully!');
        }else{
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'Error Occurred!');
        }

        return redirect()->route('page.index');
    }

    private function getEventSlug( $tipTitle ) {

        $slug = Str::slug( $tipTitle );
        $slugs = Page::whereRaw("uniqueurl REGEXP '^{$slug}(-[0-9]*)?$'");

        if ($slugs->count() === 0) {
            return $slug;
        }

        // Get the last matching slug
        $lastSlug = $slugs->orderBy('uniqueurl', 'desc')->first()->uniqueurl;

        // Strip the number off of the last slug, if any
        $lastSlugNumber = intval(str_replace($slug . '-', '', $lastSlug));

        // Increment/append the counter and return the slug we generated
        return $slug . '-' . ($lastSlugNumber + 1);
    }

}
