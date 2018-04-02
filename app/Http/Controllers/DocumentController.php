<?php

namespace App\Http\Controllers;

use App\Document;
use App\Contact;
use App\Property;
use App\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\File;

class DocumentController extends Controller
{
	/**
	* Create a new controller instance.
	*
	* @return void
    */
    public function __construct()
    {
        $this->middleware('auth');
    }
	
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
		$documents = Document::all();
        return view('documents.index', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		return view('documents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
			'name' => 'required',
			'title' => 'required|max:100',
		]);
		
		if($request->hasFile('name')) {
			$parentID = Document::max('id');
			
			foreach($request->file('name') as $docFile) {
				$document = new Document();
				$document->title = $request->title;
				$document->parent_doc = $parentID + 1;
				$document->name = $path = $docFile->store('public/documents');
				// dd($document);
				
				if($docFile->guessExtension() == 'png' || $docFile->guessExtension() == 'jpg' || $docFile->guessExtension() == 'jpeg' || $docFile->guessExtension() == 'gif' || $docFile->guessExtension() == 'bmp') {
					// Document is an image
					$image = Image::make($docFile->getRealPath())->orientate();
					$image->save(storage_path('app/'. $path));
				}

				$document->save();
			}
		}
		
		return redirect()->action('DocumentController@edit', $document)->with('status', "<li class='okItem green progress-bar-striped'>Documents(s) Added Successfully</li>");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Document  $Document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $Document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Document  $Document
     * @return \Illuminate\Http\Response
     */
    public function edit($document)
    {
		$document = Document::find($document);
		
        return view('documents.edit', compact('document'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Document  $Document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'title' => 'required|max:100',
		]);
		
		$file = Document::find($id);

		if($file->group_Document) {
			foreach($file->group_Document as $groupFile) {
				if(isset($request->contact_id)) {$groupFile->contact_id = $request->contact_id;}
				if(isset($request->property_id)) {$groupFile->property_id = $request->property_id;}
				$groupFile->title = $request->title;
				$groupFile->save();
			}
		} else {
			$file->title = $request->title;
			if(isset($request->contact_id)) {$file->contact_id = $request->contact_id;}
			if(isset($request->property_id)) {$file->property_id = $request->property_id;}
			$file->save();
		}
		
		return redirect()->back()->with('status', "<li class='okItem green progress-bar-striped'>Document(s) Updated Successfully</li>");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Document  $Document
     * @return \Illuminate\Http\Response
     */
    public function destroy($file)
    {
		$file = Document::find($file);
        $file->delete();
		
		return redirect()->action('DocumentController@index', $file)->with('status', "<li class='okItem green progress-bar-striped'>Document Deleted Successfully</li>");
    }
}
