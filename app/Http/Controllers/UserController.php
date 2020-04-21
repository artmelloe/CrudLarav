<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/
	
	public function index()
	{
		$users = User::all();
		
		return view('users.index',compact('users'));
	}
	
	 /**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/
	
	public function trashed()
	{
		$users = User::onlyTrashed()->get();
		
		return view('users.trashed',compact('users'));
	}
	
	/**
	* Show the form for creating a new resource.
	*
	* @return \Illuminate\Http\Response
	*/
	
	public function create()
	{
		return view('users.create');
	}
	
	/**
	* Store a newly created resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	
	public function store(Request $request)
	{
		$request->validate([
			'name' => 'required',
			'email' => 'required',
			'phone' => 'required',
		]);
		
		$user = User::withTrashed()->where('email', $request->email)->first();
		
		if($user)
		{
			return redirect()->route('users.create')->with('error','O email já existe!');
		}
		
		User::create($request->all());
		
		return redirect()->route('users.index')->with('success','Usuário criado com sucesso!');
	}
	
	/**
	* Display the specified resource.
	*
	* @param  \App\User  $user
	* @return \Illuminate\Http\Response
	*/
	
	public function show(User $user)
	{
		//
	}
	
	/**
	* Show the form for editing the specified resource.
	*
	* @param  \App\User  $user
	* @return \Illuminate\Http\Response
	*/
	
	public function edit(User $user)
	{
		return view('users.edit',compact('user'));
	}
	
	/**
	* Update the specified resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @param  \App\User  $user
	* @return \Illuminate\Http\Response
	*/
	
	public function update(Request $request, User $user)
	{
		$request->validate([
			'name' => 'required',
			'email' => 'required',
			'phone' => 'required',
		]);
		
		$check_email = User::withTrashed()->where('email', $request->email)->first();
		
		if($check_email && $check_email->id != $user->id)
		{
			return redirect()->route('users.edit', $user->id)->with('error','O email já existe!');
		}
		
		$user->update($request->all());
		
		return redirect()->route('users.index')->with('success','Usuário editado com sucesso!');
	}
	
	/**
	* Remove the specified resource from storage.
	*
	* @param  \App\User  $user
	* @return \Illuminate\Http\Response
	*/
	
	public function destroy(User $user)
	{
		$user = User::find($user->id);
		$user->delete();
		
		return redirect()->route('users.index')->with('success','Usuário deletado com sucesso!');
	}
}
