<?php

namespace App\Http\Controllers;
use App\Models\Statics;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Auth;

class StaticsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statics = Statics::All();
        return view('vendor.adminlte.statics.index',['statics'=>$statics]);
    }

//     /**
//      * Show the form for creating a new resource.
//      *
//      * @return \Illuminate\Http\Response
//      */
    public function create()
    {
        return view('vendor.adminlte.statics.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $statics = new Statics;
        // $statics->Content = $request->Content_Create;

        // $statics->URL = $request->Url_Create;

        ///static new
        $statics->Status = null;
        $statics->Type = $request->Type_Create;
        $statics->Language = $request->Language_Create;
        $statics->Pagename = $request->Pagename_Create;
        $statics->Title = $request->Title_Create;
        $statics->Description = $request->Description_Create;
        $statics->Post = $request->Post_Create;
        $statics->save();
        return redirect()->route("statics.index")->with('Create statics successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $statics = Statics::find($id);
        return view('vendor.adminlte.statics.show',['statics'=>$statics]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $statics = Statics::find($id);
        return view('vendor.adminlte.statics.edit', ['statics' => $statics->id]);
    }
    public function getUrl($url){
        return view('vendor.adminlte.statics.getUrl',[])->with('url', $url);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $statics = Statics::find($id);
        $statics->Status = $request->Status_Edit;
        $statics->Language = $request->Language_Edit;
        $statics->Pagename = $request->Pagename_Edit;
        $statics->Type = $request->Type_Edit;
        $statics->Title = $request->Title_Edit;
        $statics->Description = $request->Description_Edit;
        $statics->Post = $request->Post_Edit;



        //image
        // if(empty($request->Img_Edit)){
        //     $statics->Image = $request->Image_Create;
        // }
        // else{
        //     $img_path = 'ImagesStatics/'.$request->Image_Create;
        //     if(File::exists($img_path)){
        //         File::delete($img_path);
        //     }
        //     $inputImg = $request->Img_Edit;
        //     $extension = $request->Img_Edit->extension();
        //     $imgName = time().'-1.'.$extension;
        //     $inputImg->move(public_path('ImagesStatics'), $imgName);
        //     $request->Img_Edit = $imgName;
        //     $statics->Image = $request->Img_Edit;
        // }
        $statics->save();

        return redirect()->route('statics.index')->with('success','Update success');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request )
    {
        $promotion = Statics::find($request->id);
        // print_r($request->id);
        // exit;
        $promotion->Status = 1;
        $promotion->save();
        return redirect()->route('statics.index')->with('statics deleted successfull');
    }

    public function dtajax(Request $request){

        if ($request->ajax())
        {

                $statics = Statics::where('Status',1);
                if(empty($request->status))
                {
                    $statics = Statics::whereNull('Status');
                }


                //000
                // if (empty($request->status) && !empty($request->type));
                // {
                //     $statics = Statics::where([['Status','=',$request->status],['Type','=',$request->Type]]);
                // }

                // if(!empty($request->status))
                // {
                //     $statics = Statics::whereNull('Status');
                // }
                //1000
                if(!empty($request->type) && empty($request->status) && empty($request->language)&& empty($request->input))
                {
                    $statics = Statics::where([['Status','=',$request->status],['Type','=', $request->type]]);
                }
                //0100
                else if(empty($request->type) && !empty($request->status) && empty($request->language)&& empty($request->input))
                {
                    $statics = Statics::where([['Status','=',1]]);
                }
                //0010
                else if(empty($request->type) && empty($request->status) && !empty($request->language)&& empty($request->input))
                {
                    $statics = Statics::where([['Status','=',$request->status],['Language','=', $request->language]]);
                }
                //0001
                else if(empty($request->type) && empty($request->language) && empty($request->status) && !empty($request->input))
                {
                    $statics = Statics::where([['Status','=',$request->status],['Pagename','=', $request->input]]);
                }
                // 1100
                else if( !empty($request->type) && !empty($request->status)&& empty($request->language) && empty($request->input))
                {
                    $statics = Statics::where([['Status','=',1],['Type','=', $request->type]]);
                }
                //0110
                else if(empty($request->type) && !empty($request->status) && !empty($request->language) && empty($request->input))
                {
                    $statics = Statics::where([['Status','=',1],['Language','=', $request->language]]);
                }
                //0011
                else if( !empty($request->language) && !empty($request->input)&& empty($request->status) && empty($request->type) )
                {
                    $statics = Statics::where([['Status','=',$request->status],['Language','=', $request->language],['Pagename','=', $request->input]]);
                }
                //1010
                else if( !empty($request->type) && empty($request->status) && !empty($request->language) && empty($request->input))
                {
                    $statics = Statics::where([['Language','=', $request->language],['Type','=', $request->type],['Status','=',$request->status]]);
                }
                //1001
                else if( !empty($request->type) && !empty($request->input) && empty($request->status) && empty($request->language) )
                {
                    $statics = Statics::where([['Pagename','=', $request->input],['Type','=', $request->type],['Status','=',$request->status]]);
                }
                //1110
                else if(!empty($request->type) && !empty($request->status) && !empty($request->language) && empty($request->input))
                {
                    $statics = Statics::where([['Language','=', $request->language],['Type','=', $request->type],['Status','=',1]]);
                }
                //0111
                else if(empty($request->type) && !empty($request->status) && !empty($request->language) && !empty($request->input))
                {
                    $statics = Statics::where([['Language','=', $request->language],['Pagename','=', $request->input],['Status','=',1]]);
                }
                //1011
                else if (!empty($request->type) && empty($request->status) && !empty($request->input) &&!empty($request->language))
                {
                    $statics = Statics::where([['Language','=', $request->language],['Status','=',$request->status],['Type','=', $request->type],['Pagename','=', $request->input]]);
                }
                //1101
                else if (!empty($request->type) && !empty($request->status) && !empty($request->input) && empty($request->language))
                {
                    $statics = Statics::where([['Type','=', $request->type],['Status','=',1],['Pagename','=', $request->input]]);
                }
                //1111
                else if (!empty($request->type) && !empty($request->status) && !empty($request->input) && !empty($request->language))
                {
                    $statics = Statics::where([['Language','=', $request->language],['Status','=',1],['Type','=', $request->type],['Pagename','=', $request->input]]);
                }
                // if(!empty($request->language) && !empty($request->type) && empty($request->status))
                // {
                //     $statics = Statics::where([['Status','=',$request->status],['Type','=', $request->type],['Language','=', $request->language]]);
                // }
                // if(empty($request->type) && empty($request->status) && !empty($request->language))
                //     $statics = Statics::where([['Language','=',$request->language]]);
                //     if($request->status != "Type"){
                //         $statics->where($request->status,$request->input);
                //     }
                //     else{
                //         $data = $request->input;
                //         $statics->whereHas('Type', function ($query) use ($data) {
                //             return $query->where('Pagename',"like", $data."%");
                //         });
                //     }
                // }else{
                //     // $user->whereHas('roles', function ($query) {
                //     //     return $query->where('name','!=', 'super admin');
                //     // });
                // }
                $out =  Datatables::of($statics->get())->make(true);

                $data = $out->getData();



                // $out =  Datatables::of(Modules::whereNull("is_delete")->get())->make(true);
                // $data = $out->getData();
                for($i=0; $i < count($data->data); $i++) {
               $output = '';
                $output .= ' <a href="'.url(route('statics.show',['id'=>$data->data[$i]->_id])).'" class="btn btn-info btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-eye"></i></a>';
                //    if(Auth::user()->can('news-update')){
                if(empty($request->status)){
                $output .= ' <a href="'.url(route('statics.edit',['id'=>$data->data[$i]->_id])).'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
                    // }
                // ->can('statics-delete')
                //     if(Auth::user()){
                $output .= ' <a data-toggle="modal" data-target="#demoModal-'.$data->data[$i]->_id.'" data-id="'.$data->data[$i]->_id.'" class="btn btn-danger btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-ban"></i></a>';
                $output .= '
                <form method="post" action="'.url(route('statics.destroy')).'")>
                        <input type="hidden" name="id" value="'.$data->data[$i]->_id.'">
                        <input type="hidden" name="_token" value="'.csrf_token().'" />
                            <div class="modal" id="demoModal-'.$data->data[$i]->_id.'">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Do you want delete? </h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                            <button type="button" class="btn" data-dismiss="modal">Close</button>
                                        </div>
                                        </div>
                                </div>
                                </div>
                        </form>
                ';
                }
               $data->data[$i]->action = (string)$output;
                }
                $out->setData($data);
                return $out;
       }
   }
}
