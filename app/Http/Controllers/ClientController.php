<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientsStoreRequest;
use App\Models\Client;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
  
      $seller = Auth::user();
      // Retrieve products associated with the logged-in user who has the "seller" role
      $clients = Client::all();
     
          return view('auth.sellers.seller.clients.index', ['clients' => $clients,'seller'=>$seller]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(User $seller)
    {
      $seller = Auth::user();
    return view('auth.sellers.seller.clients.client_create',['seller'=>$seller]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientsStoreRequest $request)
{
    $input = $request->validated();

    // Add any other necessary validation and processing for client data.

    if (!empty($input['cover']) && $input['cover']->isValid()) {
        $file = $input['cover'];

        $path = $file->store('public/clients'); // Store client images in a separate directory, e.g., 'public/clients'.

        $input['cover'] = $path;
    }

    // Create the client with the provided data.
    Client::create($input);

    return redirect()->route('clients.index'); // Assuming you have a route named 'clients.index' for listing clients.
}

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
      return view('auth.sellers.seller.clients.edit',[
          'client' => $client
      ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClientsStoreRequest $request, Client $client)
{
    $data = $request->validated();
    if ($request->hasFile('cover')) {
        
        // Handle the uploaded image here.
        $uploadedImage = $request->file('cover');

        // Generate a unique filename for the uploaded image to prevent overwriting existing images.
        $filename = time() . '_' . $uploadedImage->getClientOriginalName();

        // Define the directory where the image will be stored.
        $imagePath = 'public/client_covers';

        // Move the uploaded image to the specified directory.
        $uploadedImage->storeAs($imagePath, $filename);

        // Update the 'cover' field in the database with the new image path.
        $data['cover'] = 'client_covers/' . $filename;
    }

    $client->update($data);

    return redirect()->route('clients.index'); // Assuming you have a route for listing clients.
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
  {
    $client->delete();
    Storage::delete($client->cover ?? '');
    return Redirect::route('index.products');
  }
  public function destroyImage(Client $client)
  {


    Storage::delete($client->cover);

    $client->cover = null;
    Storage::delete($client->cover ?? '');

    $client->save();

    return Redirect::back();
  }

}
