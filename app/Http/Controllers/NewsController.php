<?php

namespace App\Http\Controllers;
use App\Models\News;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Auth;
class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::All();
        return view('vendor.adminlte.news.index',['news'=>$news]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vendor.adminlte.news.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $news = new News;
        $news->Order = $request->Order_Create;
        $date = Carbon::now();
        $date = Carbon::parse($date)->format('Y-m-d');
        $news->Title = $request->Title_Create;
        $news->Language = $request->Language_Create;
        $news->Description = $request->Description_Create;
        $news->Createday = $date;
        // print_r( $news->Createday);
        // exit;
        $news->Status = null;
        $news->Body = $request->Body_Create;
        // $appointment->date_of_approval->format('Y-m-d');
        // $news->Createday = $date;
        // $news->DateString = $request->dateString;


        $news->save();
        return redirect()->route("news.index")->with('add','Create news successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = News::find($id);
        return view('vendor.adminlte.news.show',['news'=>$news]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::find($id);
        return view('vendor.adminlte.news.edit', ['news' => $news->id]);
    }
    public function getUrl($url){
        return view('vendor.adminlte.news.getUrl',[])->with('url', $url);
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
        // print_r($id);
        // exit;
        $news = News::find($id);
        $news->Title = $request->Title_Edit;
        $news->Description = $request->Description_Edit;
        $news->Language = $request->Language_Edit;
        $news->Order = $request->Order_Edit;
        $news->Body = $request->Body_Edit;
        $news->save();

        return redirect()->route('news.index')->with('success','Update success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request )
    {
        $promotion = News::find($request->id);
        // print_r($request->id);
        // exit;
        $promotion->Status = 1;
        $promotion->save();
        return redirect()->route('news.index')->with('delete','news unactive successfully');
    }

    public function dtajax(Request $request){
        if ($request->ajax()) {

            // if(!empty($request->dateString))
            // {
            //     $data->data[$_id]('post')->whereBetween('date', array($request->from,$request->to) );
            // }
            // else
            // {
            //     $data->data[$_id]('post')->orderBy('date', 'desc');
            // }

            // $out =  Datatables::of($news->get())->make(true);

            // $data = $out->getData();
            $news = News::where('Status',1);
            $from = Carbon::parse($request->from)->format('Y-m-d');
            // $request->from = Carbon::createFromDate('2022, 6, 1)');
            // $request->to = Carbon::createFromDate('2015, 7, 1)');
            $to = Carbon::parse($request->to)->format('Y-m-d');
            // Carbon\Carbon::parse($appointment->date_of_approval)->format('Y-m-d');
            // $from = Carbon::parse($request->input('from'));
            // $to = Carbon::parse($request->input('to'));
                //010
                if(empty($request->status) && !empty($request->from) && !empty($request->to) && empty($request->input))
                {
                    $news = News::where([['Status','=',$request->status]])->whereBetween('Createday', array($from,$to));
                }
                //110
                else if(!empty($request->status) && !empty($request->from) && !empty($request->to) && empty($request->input))
                {
                    $news = News::where([['Status','=',1]])->whereBetween('Createday', array($from,$to));
                }
                //011
                else if(empty($request->status) && !empty($request->from) && !empty($request->to) && !empty($request->input))
                {
                    $news = News::where([['Status','=',$request->status],['Title','=', $request->input]])->whereBetween('Createday', array($from,$to));
                }
                //111
                else if(!empty($request->status) && !empty($request->from) && !empty($request->to) && !empty($request->input))
                {
                    $news = News::where([['Status','=',1],['Title','=', $request->input]])->whereBetween('Createday', array($from,$to));
                }


                    // $news = News::whereBetween('created_at',[$from,$to]);


                $out =  Datatables::of($news->get())->make(true);

                $data = $out->getData();

        //    $out =  Datatables::of(News::whereNull("is_delete")->get())->make(true);
        //    $data = $out->getData();
           for($i=0; $i < count($data->data); $i++) {
               $output = '';
               $output .= ' <a href="'.url(route('news.show',['id'=>$data->data[$i]->_id])).'" class="btn btn-info btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-eye"></i></a>';
            //    if(Auth::user()->can('news-update')){
                $output .= ' <a href="'.url(route('news.edit',['id'=>$data->data[$i]->_id])).'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
                // }
                // if(Auth::user()->can('news-delete')){
                $output .= ' <a data-toggle="modal" data-target="#demoModal-'.$data->data[$i]->_id.'" data-id="'.$data->data[$i]->_id.'" class="btn btn-danger btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-ban"></i></a>';
                $output .= '
                <form method="post" action="'.url(route('news.destroy')).'">
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
            //    }
               $data->data[$i]->action = (string)$output;
           //     if($this->show_action) {
           //         $output = '';
           // //         // $output .= '<button class="btn btn-warning btn-xs" label="Open Modal" data-toggle="modal" data-target="#exampleModal" type="submit"><i class="fa fa-edit"></i></button>';
           //         $output .= ' <a href="'.url(route('bnpl.edit').'/'.$data->data[$i]->_id).'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
           // //         // $output .= ' <a href="'.url(route('employee.show',['id'=>$data->data[$i]->_id])).'" class="btn btn-info btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-eye"></i></a>';
           // //         // $output .= Form::open(['route' => [config('employee') . '.employee', $data->data[$i]->_id], 'method' => 'delete', 'style'=>'display:inline']);
           // //         // $output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
           //             // $output .= Form::close();
           //         $data->data[$i]->action = (string)$output;
           //     }
            }
           $out->setData($data);
           return $out;
       }
   }
}
