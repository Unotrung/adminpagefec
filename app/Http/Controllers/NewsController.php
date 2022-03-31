<?php

namespace App\Http\Controllers;
use App\Models\News;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('vendor.adminlte.news.index');
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
        $news->Title = $request->Title_Create;
        $news->Content = $request->Content_Create;
        $news->Description = $request->Description_Create;
        $news->URL = $request->Url_Create;
        //$news->Image = $request->Img_Create;

        $inputImg = $request->Img_Create;
        $extension = $request->Img_Create->extension();
        $imgName = time().'-1.'.$extension;
        $inputImg->move(public_path('ImagesNews'), $imgName);
        $request->Img_Create = $imgName;
        $news->Image = $request->Img_Create;
        $news->Author = $request->Author_Create;
        $news->save();
        return redirect()->route("news.index")->with('Create news successfully');
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
        $news = News::find($id);
        $news->Title = $request->Title_Edit;
        $news->Description = $request->Description_Edit;
        $news->Content = $request->Content_Edit;
        $news->URL = $request->Url_Edit;
        $news->Author = $request->Author_Edit;
        //image
        if(empty($request->Img_Edit)){
            $news->Image = $request->Image_Create;
        }
        else{
            $img_path = 'ImagesNews/'.$request->Image_Create;
            if(File::exists($img_path)){
                File::delete($img_path);
            }
            $inputImg = $request->Img_Edit;
            $extension = $request->Img_Edit->extension();
            $imgName = time().'-1.'.$extension;
            $inputImg->move(public_path('ImagesNews'), $imgName);
            $request->Img_Edit = $imgName;
            $news->Image = $request->Img_Edit;
        }
        $news->save();
        
        return redirect()->route('news.index')->with('success','News updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $promotion = News::find($id);
        $promotion->is_delete = 1;
        $promotion->save();
        return redirect()->route('news.index')->with('News deleted successfull');
    }

    public function dtajax(Request $request){
        if ($request->ajax()) {
           $out =  Datatables::of(News::whereNull("is_delete")->get())->make(true);
           $data = $out->getData();
           for($i=0; $i < count($data->data); $i++) {
               $output = '';
               $output .= ' <a href="'.url(route('news.show',['id'=>$data->data[$i]->_id])).'" class="btn btn-info btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-eye"></i></a>';
                $output .= ' <a href="'.url(route('news.edit',['id'=>$data->data[$i]->_id])).'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
               $output .= ' <a href="'.url(route('news.delete',['id'=>$data->data[$i]->_id])).'" class="btn btn-danger btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-ban"></i></a>';
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
