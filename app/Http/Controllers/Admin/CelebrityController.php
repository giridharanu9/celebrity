<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Celebrity;
use App\Category;
use App\Skill;
use DB;
use Illuminate\Support\Str;
use App\RatingQuestion;
use App\Ratings;
use Log;
use Image;
use Response;
class CelebrityController extends Controller
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
        return view('admin.celebrity.list');
    }

    public function listDatatable(REQUEST $request){
        $requestData= $_REQUEST;

        $categoriesArr = [];
        $categories = Category::where('status', 1)->get();
        foreach ($categories as $row) {
            $categoriesArr[$row['id']] = $row['categorytitle'];
        }

        $columns = array('id', 'name', 'categories.categorytitle');
        $sql = "select celebrities.*, categories.categorytitle from celebrities left join categories on categories.id= celebrities.categoryid";
        $resultData = DB::select($sql);
        $totalData = count($resultData);
        // if there is no search parameter then total number rows = total number filtered rows.
        $totalFiltered = $totalData;


        $sql = "select celebrities.*, categories.categorytitle from celebrities left join categories on categories.id= celebrities.categoryid";

        if( !empty($requestData['search']['value']) ) {
            $sql.=" WHERE ( celebrities.id LIKE '%".$requestData['search']['value']."%' ";
            $sql.=" OR name LIKE '%".$requestData['search']['value']."%'  ";
            $sql.=" OR categories.categorytitle LIKE '%".$requestData['search']['value']."%' ) ";
        }
        $resultData = DB::select($sql);
        //if there is a search parameter then modify total number filtered rows as per search result.
        $totalFiltered = count($resultData);

        $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
        $resultData = DB::select($sql);

        $data = array();
        if(count($resultData) > 0){
            foreach($resultData as $row){
                $edit_url = route('celebrity.edit', $row->id);
                $nestedData=array();

                $nestedData[] = $row->id;
                $nestedData[] = ucfirst($row->name);
                $nestedData[] = $categoriesArr[$row->categoryid];

                $img = ($row->image) ?  url('/').'/public/uploads/celebrity/'.$row->id.'/'.$row->image : url('/').'/public/admin/images/user2.png';

                $nestedData[] = '<div><img style="width:50px;" src="'.$img.'"></div>';
                if($row->status == 1){
                    $nestedData[] = '<div class="statusBtn'.$row->id.'"><a href="javascript:void(0);" onclick="changeStatus(\''.$row->id.'\', \'0\')" class="btn btn-success btn-sm" title="Click here to make it inactive">Active</a></div>';
                }else{
                    $nestedData[] = '<div class="statusBtn'.$row->id.'"><a href="javascript:void(0);" onclick="changeStatus(\''.$row->id.'\', \'1\')" class="btn btn-danger btn-sm" title="Click here to make it active" >Inactive</a></div>';
                }

                $nestedData[] = '<a class="btn btn-info btn-sm" href="'.$edit_url.'"><i class="fa fa-edit"></i></a>
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
        return view('admin.celebrity.create')->with(['categoryData' => $categories, 'skillsData' => $skills]);
    }

    public function getSubCategories(Request $request, $id)
    {
        if($request->ajax()){
          $categories = Category::where('status', 1)
                        ->where('category_parent', $id)
                        ->get();
          return Response::json( $categories );

        }
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
        $input = request()->validate([
                'celebrityname' => 'required|max:225|min:2',
                'celebritydetails' => 'required|min:10',
                'category' => 'required',
                'gender' => 'required',
                'date_of_birth' => 'required',
                'skills' => 'required',
                'twitter_id' => 'required',
                'insta_frame' => 'required',
                'fb_frame' => 'required',
                'userpic' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

        $getuniqueurl = $this->getEventSlug($request->get('celebrityname'));

        $celebrity = new Celebrity;
        $celebrity->name = $request->get('celebrityname');
        $celebrity->gender = $request->get('gender');
        $celebrity->date_of_birth = $request->get('date_of_birth');
        $celebrity->description = $request->get('celebritydetails');
        if(!empty($request->get('sub_category')))
        {
          $celebrity->categoryid = $request->get('sub_category');
          $celebrity->parent_category_id = $request->get('category');
        }
        else
        {
          $celebrity->categoryid = $request->get('category');
          $celebrity->parent_category_id = 0;
        }
       // die;
        //$celebrity->categoryid = $request->get('category');
        $celebrity->skills = implode(',', $request->get('skills'));
        $celebrity->twitter_id = $request->get('twitter_id');
        $celebrity->insta_frame = $request->get('insta_frame');
        $celebrity->fb_frame = $request->get('fb_frame');
        $celebrity->uniqueurl = $getuniqueurl;

        $dateOfBirth = $celebrity->date_of_birth;
        $today = date("Y-m-d");
        $diff = date_diff(date_create($dateOfBirth), date_create($today));
        $celebrity->age = $diff->format('%y');

        $celebritySave = $celebrity->save();

        $lastInsertedId = $celebrity->id;

        if ($request->hasFile('userpic')) {
            // to upload file
            $file = $request->file('userpic');
            $destinationPath = public_path(). '/uploads/celebrity/'.$lastInsertedId.'/';
            $filename = $file->getClientOriginalName();
            $getExtension = $file->guessExtension();
            $newfilename = time().'_'.$getuniqueurl.'.'.$getExtension;
            $file->move($destinationPath, $newfilename);

            $celebrityUpdate = Celebrity::where('id', $lastInsertedId)->update(['image' => $newfilename]);
        }

        if($lastInsertedId){
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Celebrity details have been added successfully!');
        }else{
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'Error Occurred!');
        }

        return redirect()->route('celebrity.index');
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
        $categories = Category::where('status', 1)
        ->where('category_parent', 0)
        ->get();
        $skills = Skill::where('status', 1)->get();
        $celebrityData = Celebrity::where('id', $id)-> first();
        $subcategories="";
        if(!empty($celebrityData->parent_category_id))
        {
          $subcategories = Category::where('status', 1)
          ->where('category_parent', $celebrityData->parent_category_id)
          ->get();
         // echo "<pre>";
         // print_r($subcategories);
        }
        return view('admin.celebrity.edit', ['categoryData' => $categories, 'subCategoryData' => $subcategories, 'skillsData' => $skills, 'celebrityData' => $celebrityData]);
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
                'celebrityname' => 'required|max:225|min:2',
                'celebritydetails' => 'required|min:10',
                'category' => 'required',
                'skills' => 'required',
            ]);

        if(!empty($request->get('sub_category')))
        {
          $categoryid = $request->get('sub_category');
          $parent_category_id = $request->get('category');
        }
        else
        {
          $categoryid = $request->get('category');
          $parent_category_id = 0;
        }
        $updateArr = [
            'name' => $request->get('celebrityname'),
            'description' => $request->get('celebritydetails'),
            'categoryid' => $categoryid,
            'parent_category_id' => $parent_category_id,
            'skills' => implode(',', $request->get('skills'))
        ];

        if ($request->hasFile('userpic')) {
            $destinationPath = public_path(). '/uploads/celebrity/'.$id.'/';

            $getImage = Celebrity::select ('image', 'uniqueurl')->where ('id', $id)->first();
            if(file_exists($destinationPath.$getImage->image)){
              unlink($destinationPath.$getImage->image);
            }
            // to upload file
            $file = $request->file('userpic');
            $filename = $file->getClientOriginalName();
            $getExtension = $file->guessExtension();
            $newfilename = time().'_'.$getImage->uniqueurl.'.'.$getExtension;
            $file->move($destinationPath, $newfilename);

            $updateArr['image'] = $newfilename;
        }
        $celebrityUpdate = Celebrity::where('id', $id)->update($updateArr);


        if($celebrityUpdate){
            $request->session()->flash('message.level', 'success');
            $request->session()->flash('message.content', 'Celebrity details have been updated successfully!');
        }else{
            $request->session()->flash('message.level', 'danger');
            $request->session()->flash('message.content', 'Error Occurred!');
        }

        return redirect()->route('celebrity.index');
    }

    private function getEventSlug( $tipTitle ) {

        $slug = Str::slug( $tipTitle );
        $slugs = Celebrity::whereRaw("uniqueurl REGEXP '^{$slug}(-[0-9]*)?$'");

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


    public function polls()
    {
        $celebrity = Celebrity::get();
        $categories = Category::get();
        $rating_question = RatingQuestion::get();
        return view('admin.celebrity.polls',compact('rating_question','celebrity','categories'));
    }

    public function usersRating($id)
    {
        $celebrity = Celebrity::find($id);
        $rating_question = RatingQuestion::get();
        $ratings = Ratings::where('celebrity_id',$id)->get();
        return view('admin.celebrity.users_rating',compact('rating_question','ratings','celebrity'));
    }


    public function getCelebrityLikesRank($id)
    {

    }

    /**
     * Import csv file.
     *
     * @return \Illuminate\Http\Response
     */

     public function getImportCsv()
     {
        return view('admin.celebrity.import_csv');
     }



     public function importCsv(Request $request)
     {
       ini_set('max_execution_time', 120);

       $input = request()->validate([
               'file' => 'required',
       ]);

       $file =$request->file('file');

       if($file){
         $filename = $file->getClientOriginalName();
         $path = $file->getPathName();

       $results = Excel::load($path,function($reader){
       })->get();

       $arr = [];
       foreach($results as $res){

       if($res->category){
         $getCategory = Category::where('categorytitle', $res->category)->first();
       }

      //  $celebrities = Celebrity::where('name','=',$res->name)->first();
        $celebrities = DB::table('celebrities')
                       ->select('*')
                        ->where('name', '=', $res->name)
                        ->where('categoryid', '=', $getCategory->id)
                        ->where('gender', '=', $res->gender)
                        ->where('date_of_birth', '=', $res->date_of_birth)
                        ->get();

        if(count($celebrities)== '0'){

          if($res->name && $res->category && $res->gender && $res->date_of_birth){
            $exists = Storage::disk('image')->exists($res->image);

              $url='';
              $imageName='';
              if($exists){
                 // $url = @file_get_contents($exists);
                 $url = 'storage';
                 $imageName = $res->image;

              }else{
                 $url = @file_get_contents($res->image);
                 $imageName = time().'_'.basename($res->image);
                 $path = ('image/' . $imageName);
                 $destination_path = \Storage::disk('image')->put($imageName, $url);
              }

              if($url || $url = 'storage'){
                 if($res->category){
                   $getCategory = Category::where('categorytitle', $res->category)->first();
                 }
                 if($res->skill){
                   $getSkill = Skill::where('skilltitle', $res->skill)->first();
                 }

                  $getuniqueurl = $this->getEventSlug($res->name);

                  $dateOfBirth = $res->date_of_birth ;
                  $today = date("Y-m-d");
                  $diff = date_diff(date_create($dateOfBirth), date_create($today));
                  $res->age = $diff->format('%y');

                  $query = DB::table('celebrities')->insertGetId(['name'=>$res->name,'description'=>$res->description,'categoryid'=>$getCategory->id,'parent_category_id'=>$getCategory->category_parent,
                                                              'skills'=>$getSkill->id, 'gender'=>$res->gender, 'date_of_birth'=>$res->date_of_birth ,
                                                              'age'=>$res->age,'image'=>$res->image, 'twitter_id'=>$res->twitter_id, 'insta_frame'=>$res->insta_frame,
                                                              'fb_frame'=>$res->fb_frame, 'uniqueurl'=>$getuniqueurl, 'status'=>1]);

                 $lastInsertedId = $query;
                 $imgPath = storage_path('image/' .$imageName);
                 if($imgPath){
                    $img = $imgPath;
                    $destinationPath = public_path(). '/uploads/celebrity/'.$lastInsertedId.'/';
                    mkdir($destinationPath, 0777, true);
                    $this->copy_files($imgPath, $destinationPath);
                    $celebrityUpdate = Celebrity::where('id', $lastInsertedId)->update(['image' => $imageName]);
                 }
              }

           }else{
              $msg = 'name, category, gender and date of birth are not found!';
           }
           array_push($arr, true);
         }else{
           array_push($arr, false);
         }
       }

       if(count(array_keys($arr, false)) == count($arr)){
         $request->session()->flash('message.level', 'danger');
         $request->session()->flash('message.content', 'Celebrity details is already exists!');
       }else{
         $request->session()->flash('message.level', 'success');
         $request->session()->flash('message.content', 'Celebrity details have been added successfully!');
       }

     }
     return redirect()->back();
    }

  function copy_files($file_path, $dest_path){
    if (strpos($file_path, '/') !== false) {
        $pathinfo = pathinfo($file_path);
        $dest_path = str_replace($pathinfo['dirname'], $dest_path, $file_path);
    }else{
        $dest_path = $dest_path.'/'.$file_path;
    }
    return copy($file_path, $dest_path);
}

}
