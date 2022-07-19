<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-center text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                <form action="{{ route('uploadFile') }}" method="post" enctype="multipart/form-data" class="mx-5 my-2  flex justify-end">
                        @csrf
                    
                        <input type="file" class="rounded-l-sm p-1 border-t mr-0 border-b border-l text-gray-800 border-gray-200 bg-white" id="userFile" name="userFile">
                        <button type="submit" class="focus:outline-none text-white text-sm py-1 px-5 rounded-md bg-green-500 hover:bg-green-600 hover:shadow-lg">Upload</button>
                        
                </form>
                @if (session()->has('message'))
                        <div class="py-3 px-5 mb-4 bg-green-100 text-center text-green-900 text-lg rounded-md border border-green-200" role="alert">
                                {{ session('message') }}
                            </div>
                        @endif
                    <table class="rounded-lg m-5 text-lg mx-auto bg-gray-200 text-gray-800">
                        <thead class="text-center py-2">
                            <tr class="bg-gray-800 text-white py-2">
                            <th class="w-1/12 ...">No</th>
                            <th class="w-1/3 ...">Nama File</th>
                            <th class="w-1/4 ...">Ukuran File</th>
                            <th class="w-1/4 ...">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($file as $f)
                            <tr>
                                <td class="text-center">{{$f->id}}</td>
                                <td>{{$f->nama_file}}</td>
                                <td class="text-center">{{$f->ukuran_file}}kb</td>
                                <td class="text-center"> 
                                    <button type="button" class="focus:outline-none text-white text-sm py-2.5 px-5 items-center inline-flex rounded-md bg-green-500 hover:bg-green-600 hover:shadow-lg"> 
                                        <a href="{{ route('downloadFile', basename($f->file)) }}">
                                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"/></svg>
                                        </a>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
