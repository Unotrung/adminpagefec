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
        $statics->Title = $request->Title_Create;
        $statics->Content = $request->Content_Create;
        $statics->Description = $request->Description_Create;
        $statics->URL = $request->Url_Create;
        $statics->Status = $request->Status_Create;
        // print_r($request->Status_Create);
        // exit;
        //$statics->Image = $request->Img_Create;
        $inputImg = $request->Img_Create;

        // $images = $request->file('Img_Create');
        // $path = $images->store('public/images');
        // $path = basename($path);

        $imgName = $request->Img_Create->getClientOriginalName();
        // print_r($imgName);
        // exit;
        // print_r($extension);
        // exit;
        // $imgName = time().'-1.'.$extension;
        $inputImg->move(public_path('ImagesStatics'), $imgName);
        $request->Img_Create = $imgName;
        // print_r($request->Img_Create);
        // exit;
        $statics->Image = $request->Img_Create;
        $statics->Author = $request->Author_Create;
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
        $statics->Title = $request->Title_Edit;
        $statics->Description = $request->Description_Edit;
        $statics->Content = $request->Content_Edit;
        $statics->URL = $request->Url_Edit;
        $statics->Author = $request->Author_Edit;
        //image
        if(empty($request->Img_Edit)){
            $statics->Image = $request->Image_Create;
        }
        else{
            $img_path = 'ImagesStatics/'.$request->Image_Create;
            if(File::exists($img_path)){
                File::delete($img_path);
            }
            $inputImg = $request->Img_Edit;
            $extension = $request->Img_Edit->extension();
            $imgName = time().'-1.'.$extension;
            $inputImg->move(public_path('ImagesStatics'), $imgName);
            $request->Img_Edit = $imgName;
            $statics->Image = $request->Img_Edit;
        }
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
        $promotion->is_delete = 1;
        $promotion->save();
        return redirect()->route('statics.index')->with('delete','Statics deleted successfull');
    }

    public function dtajax(Request $request){
        if ($request->ajax()) {
           $out =  Datatables::of(Statics::whereNull("is_delete")->get())->make(true);
           $data = $out->getData();
           for($i=0; $i < count($data->data); $i++) {
               $output = '';
                $output .= ' <a href="'.url(route('statics.show',['id'=>$data->data[$i]->_id])).'" class="btn btn-info btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-eye"></i></a>';
            //    if(Auth::user()->can('news-update')){
                $output .= ' <a href="'.url(route('statics.edit',['id'=>$data->data[$i]->_id])).'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
            //     }
            // ->can('statics-delete')
            //     if(Auth::user()){
                $output .= ' <a data-toggle="modal" data-target="#demoModal-'.$data->data[$i]->_id.'" data-id="'.$data->data[$i]->_id.'" class="btn btn-danger btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-ban"></i></a>';
                $output .= '
                <form method="head" action="">
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

               $data->data[$i]->action = (string)$output;
            }
           $out->setData($data);
           return $out;
       }
   }
}
