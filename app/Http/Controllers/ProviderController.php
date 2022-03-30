<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provider;
use DataTables;
use Illuminate\Support\Facades\File;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $providers = Provider::All();
        return view('vendor.adminlte.providers.index',['providers'=>$providers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vendor.adminlte.providers.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $providers = new Provider;
        $providers->provider = $request->name;
        $providers->address = $request->address;
        $inputImg = $request->Img_Create;
        $extension = $request->Img_Create->extension();
        $imgName = time().'-1.'.$extension;
        $inputImg->move(public_path('ImagesProvider'), $imgName);
        $request->Img_Create = $imgName;
        $providers->Image = $request->Img_Create;
        $providers->save();

        return redirect()->route('providers.index')->with('Providers created successfull');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $providers = Provider::find($id);
        return view('vendor.adminlte.providers.show',['providers'=>$providers]);
        //return redirect()->route('promotions.show',['id'=>$id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $providers = Provider::find($id);
        return view('vendor.adminlte.providers.edit', ['providers' => $providers->id]);
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
        $providers = Provider::find($id);
        $providers->provider = $request->name;
        $providers->address = $request->address;
        //image
        if(empty($request->Img_Edit)){
            $providers->Image = $request->Image_Create;
        }
        else{
            $img_path = 'ImagesProvider/'.$request->Image_Create;
            if(File::exists($img_path)){
                File::delete($img_path);
            }
            $inputImg = $request->Img_Edit;
            $extension = $request->Img_Edit->extension();
            $imgName = time().'-1.'.$extension;
            $inputImg->move(public_path('ImagesProvider'), $imgName);
            $request->Img_Edit = $imgName;
            $providers->Image = $request->Img_Edit;
        }
        $providers->save();
        return redirect()->route('providers.index')->with('success','News updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $providers = Provider::find($id);
        $providers->delete();
        return redirect()->route('providers.index')->with('providers deleted successfull');
    }

    public function dtajax(Request $request){
        if ($request->ajax()) {
        $out =  DataTables::of(Provider::All())->make(true);
           $data = $out->getData();
           for($i=0; $i < count($data->data); $i++) {
               $output = '';
               $output .= ' <a href="'.url(route('providers.show',['id'=>$data->data[$i]->_id])).'" class="btn btn-info btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-eye"></i></a>';
                $output .= ' <a href="'.url(route('providers.edit',['id'=>$data->data[$i]->_id])).'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
               $output .= ' <a href="'.url(route('providers.delete',['id'=>$data->data[$i]->_id])).'" class="btn btn-danger btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-ban"></i></a>';
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
